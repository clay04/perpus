<?php

namespace App\Services;

use Illuminate\Support\Facades\Process;
use Smalot\PdfParser\Parser;

class PdfMetadataService
{
    public static function extract(string $filePath): array
    {
        try {
            $process = Process::run("pdfinfo \"$filePath\"");

            if ($process->successful()) {
                $output = $process->output();

                preg_match('/Title:\s+(.*)/i', $output, $title);
                preg_match('/Author:\s+(.*)/i', $output, $author);
                preg_match('/Pages:\s+(\d+)/i', $output, $pages);

                if (!empty($title[1]) || !empty($author[1])) {
                    return [
                        'title'  => trim($title[1] ?? ''),
                        'author' => trim($author[1] ?? ''),
                        'pages'  => isset($pages[1]) ? (int) $pages[1] : null,
                    ];
                }
            }
        } catch (\Throwable $e) {
            // ignore → fallback
        }

        // ===== 2. FALLBACK Windows (pure PHP)
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            $details = $pdf->getDetails();

            return [
                'title'  => $details['Title'] ?? '',
                'author' => $details['Author'] ?? '',
                'pages'  => count($pdf->getPages()),
            ];
        } catch (\Throwable $e) {
            return [];
        }
    }
}