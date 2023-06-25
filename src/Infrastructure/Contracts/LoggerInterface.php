<?php

namespace App\Infrastructure\Contracts;

interface LoggerInterface
{
    public static function log($file, $message): void;
}