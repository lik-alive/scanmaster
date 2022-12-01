<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MonitorAction
{
    public function view(Request $request, Response $response)
    {
        if (!isset($_SESSION['user'])) {
            return redirect($response, '/login');
        }

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
                'time' => date("H:i:s", $mtime),
                'is_pdf' => $ext === 'pdf'
            ];

            // Create preview for pdf-files
            if ($ext === 'pdf') {
                $prev = $folder . 'prev_' . $name . '.jpg';

                if (!file_exists($prev)) {
                    $pdf_arg = escapeshellarg($file);
                    $jpg_arg = escapeshellarg($prev);

                    // Prevent task overlapping
                    $task_list = [];
                    exec("tasklist /fi \"ImageName eq convert.exe\"", $task_list);
                    if (count($task_list) === 1) {
                        exec("convert -density 72 {$pdf_arg}[0] {$jpg_arg}");
                    }
                }

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
