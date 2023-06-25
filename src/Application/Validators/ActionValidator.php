<?php

namespace App\Application\Validators;

use App\Application\Contracts\ValidatorInterface;

class ActionValidator implements ValidatorInterface
{
    public function validate(array $data): bool
    {
        return true;
    }
}