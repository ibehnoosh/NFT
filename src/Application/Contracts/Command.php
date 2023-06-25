<?php

namespace App\Application\Contracts;

Interface Command
{
    public function execute(): void;
    public function setValidator(ValidatorInterface $validator): void;
    //todo output handler
}