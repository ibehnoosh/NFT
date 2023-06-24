<?php

namespace App\Infrastructure\Logging;

use App\Infrastructure\Contracts\LoggerInterface;

class FileLogger implements LoggerInterface
{

    public function __construct(
        private string $logFile
    )
    {
        $fp = fopen($logFile, "w");
        fclose($fp);
    }

    public function log($message): void
    {
        file_put_contents($this->logFile, $message . PHP_EOL, FILE_APPEND);
    }
}