<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;

class FileValidator implements ValidatorInterface
{
    public function validate(array $data): bool

    {
        return true;
    }
}
