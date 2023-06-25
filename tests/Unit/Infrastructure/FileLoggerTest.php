<?php

use App\Infrastructure\Logger\FileLogger;
use PHPUnit\Framework\TestCase;

class FileLoggerTest extends TestCase
{
    private $logFile = 'tests/Unit/testFiles/test.log';

    protected function tearDown(): void
    {
        if (file_exists($this->logFile)) {
            unlink($this->logFile);
        }
    }

    public function testLog(): void
    {
        $message = 'This is a test log message.';
        $expectedContent = $message;

        FileLogger::log($this->logFile, $message);

        $this->assertFileExists($this->logFile);

        $fileContent = file_get_contents($this->logFile);

        $this->assertEquals($expectedContent, $fileContent);
    }

    public function testResetFile(): void
    {
        file_put_contents($this->logFile, 'Test log message.');

        FileLogger::resetFile($this->logFile);

        $this->assertEmpty(file_get_contents($this->logFile));
    }
}
