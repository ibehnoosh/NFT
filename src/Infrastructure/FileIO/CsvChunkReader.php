<?php

namespace App\Infrastructure\FileIO;


class CsvChunkReader
{
    public static function readFile($file, $chunkSize = 1000)
    {
        $rows = [];

        $fileObject = new \SplFileObject($file);
        $fileObject->setFlags(\SplFileObject::READ_CSV);

        while (!$fileObject->eof()) {
            $chunk = [];
            for ($i = 0; $i < $chunkSize && !$fileObject->eof(); $i++) {
                $chunk[] = $fileObject->fgetcsv();
            }

            // Process the chunk of rows here
            foreach ($chunk as $row) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
}
