<?php

namespace App\Infrastructure\Contracts;

interface FileWriterInterface
{
    public function writeFile(string $filename, array $data): void;
}
