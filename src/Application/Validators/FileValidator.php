<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;

class FileValidator implements ValidatorInterface
{
    private int $maxFileSize = 1048576; // 1 MB

    public function validate(array $data): bool
    {
        if (!isset($data['file'])) {
            return false;
        }

        $file = $data['file'];

        if (!file_exists($file)) {
            return false;
        }

        if (!is_readable($file)) {
            return false;
        }

        if (filesize($file) > $this->maxFileSize) {
            return false;
        }

        $fileInfo = pathinfo($file);
        if (!isset($fileInfo['extension']) || $fileInfo['extension'] !== 'csv') {
            return false;
        }

        return true;
    }
}
