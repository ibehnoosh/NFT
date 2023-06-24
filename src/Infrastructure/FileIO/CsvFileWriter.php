<?php
namespace App\Infrastructure\FileIO;


use App\Infrastructure\Contracts\FileWriterInterface;

class CsvFileWriter implements FileWriterInterface
{
    public static function writeFile(string $filename, array $data): void
    {
        $handle = fopen($filename, 'w');
        if ($handle !== false) {
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }
    }
}