<?php

namespace App\Domain\Contracts;

interface CalculatorInterface
{
    public static function calculate(int $num1, int $num2): ?int;
}