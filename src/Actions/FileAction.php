<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FileAction
{
    public function preview(Request $request, Response $response, $args)
    {
        $this->stream($response, $args, false);
    }

    public function download(Request $request, Response $response, $args)
    {
        $this->stream($response, $args);
    }

    public function stream($response, $args, $download = true)
    {
        $name = $args['name'];
        $path = storage_path('scans/') . $name;

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

        header('Content-Disposition: inline; filename=' . basename($path));
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        return readfile($path);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $name = $args['name'];
        $folder = storage_path('scans/');
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

        return redirect($response, '/');
    }
}
