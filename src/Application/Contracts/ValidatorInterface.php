<?php

namespace App\Application\Contracts;

interface ValidatorInterface
{
    public function validate(array $data): bool;
}