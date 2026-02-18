<?php

namespace App\Services;

use Illuminate\Support\Facades\Process;
use Smalot\PdfParser\Parser;

class PdfMetadataService
{
    public static function extract(string $filePath): array
    {
        $result = [
            'title' => '',
            'author' => '',
            'pages' => null,
            'isbn' => null,
            'publisher' => null,
            'year' => null,
            'edition' => null,
            'city' => null,
        ];

        try {
            $process = Process::run("pdfinfo \"$filePath\"");

            if ($process->successful()) {
                $output = $process->output();

                preg_match('/Title:\s+(.*)/i', $output, $title);
                preg_match('/Author:\s+(.*)/i', $output, $author);
                preg_match('/Pages:\s+(\d+)/i', $output, $pages);

                $result['title']  = trim($title[1] ?? '');
                $result['author'] = trim($author[1] ?? '');
                $result['pages']  = isset($pages[1]) ? (int)$pages[1] : null;
            }
        } catch (\Throwable $e) {}

        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            $details = $pdf->getDetails();
            $text = $pdf->getText();

            $result['title']  = $result['title'] ?: ($details['Title'] ?? '');
            $result['author'] = $result['author'] ?: ($details['Author'] ?? '');
            $result['pages']  = $result['pages'] ?: count($pdf->getPages());

            preg_match('/ISBN(?:-13)?:?\s*(97[89][0-9\-\s]+)/i', $text, $isbn13);
            preg_match('/ISBN(?:-10)?:?\s*([0-9X\-\s]{10,})/i', $text, $isbn10);

            $isbn = $isbn13[1] ?? $isbn10[1] ?? null;
            if ($isbn) {
                $result['isbn'] = preg_replace('/[^0-9X]/', '', $isbn);
            }

            preg_match('/\b(19|20)\d{2}\b/', $text, $year);
            if (!empty($year[0])) {
                $result['year'] = $year[0];
            }

            preg_match('/Published by\s+(.*)/i', $text, $publisher);
            if (!empty($publisher[1])) {
                $result['publisher'] = trim($publisher[1]);
            }

            preg_match('/(First|Second|Third|Fourth)\s+Edition/i', $text, $edition);
            if (!empty($edition[0])) {
                $result['edition'] = $edition[0];
            }

            preg_match('/Published by\s+(.*?)\n(.*?)/i', $text, $pubCity);
            if (!empty($pubCity[1])) {
                $result['publisher'] = trim($pubCity[1]);
            }
            if (!empty($pubCity[2])) {
                $result['city'] = trim($pubCity[2]);
            }

        } catch (\Throwable $e) {}

        return $result;
    }
}