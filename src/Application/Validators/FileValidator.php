<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;
use InvalidArgumentException;

class FileValidator implements ValidatorInterface
{
    private int $maxFileSize = 1048576; // 1 MB

    public function validate(array $data): bool
    {
        if (!isset($data['file'])) {
            throw new InvalidArgumentException('File argument is missing.');
        }

        $file = $data['file'];

        $this->checkFileExists($file);
        $this->checkFileReadable($file);
        $this->checkFileSize($file);
        $this->checkFileExtension($file);

        return true;
    }

    private function checkFileExists(string $file): void
    {
        if (!file_exists($file)) {
            throw new InvalidArgumentException('File does not exist.');
        }
    }

    private function checkFileReadable(string $file): void
    {
        if (!is_readable($file)) {
            throw new InvalidArgumentException('File is not readable.');
        }
    }

    private function checkFileSize(string $file): void
    {
        $fileSize = filesize($file);
        if ($fileSize > $this->maxFileSize) {
            throw new InvalidArgumentException('File size exceeds the maximum allowed limit.');
        }
    }

    private function checkFileExtension(string $file): void
    {
        $fileInfo = pathinfo($file);
        if (!isset($fileInfo['extension']) || $fileInfo['extension'] !== 'csv') {
            throw new InvalidArgumentException('Invalid file extension. Only CSV files are allowed.');
        }
    }
}