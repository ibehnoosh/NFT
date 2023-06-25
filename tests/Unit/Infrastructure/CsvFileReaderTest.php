<?php

use App\Infrastructure\FileIO\CsvFileReader;
use PHPUnit\Framework\TestCase;

class CsvFileReaderTest extends TestCase
{
    public function testReadFileExistingFile(): void
    {
        $filename =  'tests/Unit/testFiles/test.csv';

        $data = "1;11\n2;22\n3;33";
        file_put_contents($filename, $data);

        $result = CsvFileReader::readFile($filename);

        $expected = [
            ['1', '11'],
            ['2', '22'],
            ['3', '33'],
        ];
        $this->assertEquals($expected, $result);
        unlink($filename);
    }

    public function testReadFileNonExistingFile(): void
    {
        $filename = 'non_existing_file.csv';

        $result = CsvFileReader::readFile($filename);

        $this->assertNull($result);
    }
}
