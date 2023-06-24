<?php

namespace App\Infrastructure\Contracts;

interface FileWriterInterface
{
    public static function writeFile(string $filename, array $data): void;
}
