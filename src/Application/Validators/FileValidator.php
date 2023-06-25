<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;
use App\Application\Exceptions\InvalidArgumentExceptionValidator;


class FileValidator implements ValidatorInterface
{
    private int $maxFileSize = 1048576; // 1 MB

    public function validate(array $data): bool
    {
        if (!isset($data['2'])) {
            throw new InvalidArgumentExceptionValidator('File argument is missing.');
        }

        $file = $data['2'];

        $this->checkFileExists($file);
        $this->checkFileReadable($file);
        $this->checkFileSize($file);
        $this->checkFileExtension($file);

        return true;
    }

    private function checkFileExists(string $file): void
    {
        if (!file_exists($file)) {
            throw new InvalidArgumentExceptionValidator('File does not exist.');
        }
    }

    private function checkFileReadable(string $file): void
    {
        if (!is_readable($file)) {
            throw new InvalidArgumentExceptionValidator('File is not readable.');
        }
    }

    private function checkFileSize(string $file): void
    {
        $fileSize = filesize($file);
        if ($fileSize > $this->maxFileSize) {
            throw new InvalidArgumentExceptionValidator('File size exceeds the maximum allowed limit.');
        }
    }

    private function checkFileExtension(string $file): void
    {
        $fileInfo = pathinfo($file);
        if (!isset($fileInfo['extension']) || $fileInfo['extension'] !== 'csv') {
            throw new InvalidArgumentExceptionValidator('Invalid file extension. Only CSV files are allowed.');
        }
    }
}