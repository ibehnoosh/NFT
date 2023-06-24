<?php

namespace App\Infrastructure\Contracts;

interface LoggerInterface
{
    public function log($message): void;
}