<?php

namespace App\Infrastructure\Logger;

use App\Infrastructure\Contracts\LoggerInterface;

class FileLogger implements LoggerInterface
{

    public static function log($logFile , $message): void
    {
        self::resetFile($logFile);
        file_put_contents($logFile, $message, FILE_APPEND);
    }

    public static function resetFile($logFile)
    {
        $fp = fopen($logFile, "w");
        fclose($fp);
    }
}