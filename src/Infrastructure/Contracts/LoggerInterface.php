<?php

namespace App\Infrastructure\Contracts;

interface LoggerInterface
{
    public static function log(string $file, string $message): void;
}