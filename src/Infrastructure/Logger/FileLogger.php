<?php

namespace App\Infrastructure\Logger;

use App\Infrastructure\Contracts\LoggerInterface;

class FileLogger implements LoggerInterface
{

    public static function log(string $logFile , string $message): void
    {
        self::resetFile($logFile);
        file_put_contents($logFile, $message, FILE_APPEND);
    }

    public static function resetFile(string $logFile): void
    {
        $fp = fopen($logFile, "w");
        fclose($fp);
    }

}