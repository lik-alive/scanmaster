<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use ZipArchive;

class FileAction
{
    public function preview(Request $request, Response $response, $args)
    {
        $path = storage_path('scans/') . $args['name'];
        $this->stream($response, $path, false);
    }

    public function download(Request $request, Response $response, $args)
    {
        $path = storage_path('scans/') . $args['name'];
        $this->stream($response, $path);
    }

    public function mass(Request $request, Response $response)
    {
        $files = json_decode($request->getParsedBody()['files']);

        $path = tempnam(storage_path('temp/'), 'mass');
        $zip = new ZipArchive();
        $zip->open($path, ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $file_path = storage_path('scans/') . $file;
            if (!file_exists($file_path)) continue;

            $zip->addFile($file_path, basename($file_path));
        }

        $zip->close();

        // Remove file after execution
        register_shutdown_function('unlink', $path);

        $this->stream($response, $path, true, 'scans_' . date('Y-m-d_H-i-s') . ".zip");
    }

    public function stream($response, $path, $download = true, $filename = null)
    {
        if (!file_exists($path)) {
            return $response->withStatus(404);
        }

        // Downloadable stream
        if ($download) {
            header('Content-Type: application/octet-stream');
        }
        // Viewable stream
        else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if ($ext === 'pdf') {
                header('Content-Type: application/pdf');
            } else {
                header('Content-Type: image/jpeg');
            }
        }

        $filename = $filename ?? basename($path);

        header('Content-Disposition: inline; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        return readfile($path);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $names = json_decode($request->getParsedBody()['names']);
        $folder = storage_path('scans/');

        foreach ($names as $name) {
            $path = $folder . $name;

            if (file_exists($path)) {
                // Delete file
                unlink($path);

                // Delete preview
                $prev = $folder . 'prev_' . $name . '.jpg';
                if (file_exists($prev)) {
                    unlink($prev);
                }
            }
        }

        return redirect($response, '/');
    }
}
