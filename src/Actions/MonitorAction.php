<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MonitorAction
{
    public function view(Request $request, Response $response)
    {
        $scans = [];
        $folder = storage_path('scans/');
        $files = glob($folder . 'Scan*');
        foreach ($files as $file) {
            $name = basename($file);
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $mtime = filemtime($file);

            $scan = [
                'file' => basename($file),
                'mtime' => $mtime,
                'date' => date("Y-m-d", $mtime),
                'time' => date("H:i:s", $mtime)
            ];

            // Create preview for pdf-files
            if ($ext === 'pdf') {
                $prev = $folder . 'prev_' . $name . '.jpg';

                if (!file_exists($prev)) {
                    $pdf_arg = escapeshellarg($file);
                    $jpg_arg = escapeshellarg($prev);
                    exec("convert -density 72 {$pdf_arg} {$jpg_arg}");
                }

                $scan['is_pdf'] = true;
                if (file_exists($prev)) {
                    $scan['prev'] = basename($prev);
                }
            }

            $scans[] = $scan;
        }

        usort($scans, fn ($a, $b) => $b['mtime'] - $a['mtime']);

        $data = [
            'csrf_name' => $request->getAttribute('csrf_name'),
            'csrf_value' => $request->getAttribute('csrf_value'),
            'scans' => $scans
        ];

        return view($response, 'index', $data);
    }
}
