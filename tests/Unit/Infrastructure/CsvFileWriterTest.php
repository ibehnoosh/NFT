<?php

use App\Infrastructure\FileIO\CsvFileWriter;
use PHPUnit\Framework\TestCase;

class CsvFileWriterTest extends TestCase
{
    public function testWriteFile(): void
    {
        $filename =  'tests/Unit/testFiles/testWrite.csv';

        $data = [
            [1 , 11 , 111],
            [2 , 22 , 222],
            [3 , 33 , 333],
        ];

        CsvFileWriter::writeFile($filename, $data);
        $this->assertFileExists($filename);

        $fileContent = file_get_contents($filename);

        $expected = "1,11,111\n2,22,222\n3,33,333\n";

        $this->assertEquals($expected, $fileContent);

        unlink($filename);
    }
}
