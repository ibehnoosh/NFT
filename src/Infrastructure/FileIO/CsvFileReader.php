<?php

namespace App\Infrastructure\FileIO;

use App\Infrastructure\Contracts\FileReaderInterface;

class CsvFileReader implements FileReaderInterface
{
    public  static function readFile(string $filename): ?array
    {
        if (!file_exists($filename)) {
            return null;
        }

        $rows = [];
        if (($handle = fopen($filename, "r")) !== false) {
            while (($data = fgetcsv($handle, 0, ";")) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        }
        return $rows;
    }
}