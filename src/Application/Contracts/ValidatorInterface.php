<?php

namespace App\Application\Contracts;

interface ValidatorInterface
{
    /**
     * @param   array<mixed> $data
     */
    public function validate(array $data): bool;
}