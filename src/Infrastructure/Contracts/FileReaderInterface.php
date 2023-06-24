<?php

namespace App\Infrastructure\Contracts;

interface  FileReaderInterface
{
    public static function readFile(string $filename): ?array;
}