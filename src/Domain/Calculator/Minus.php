<?php

namespace App\Domain\Calculator;

use App\Domain\Contracts\CalculatorInterface;

class Minus implements CalculatorInterface
{
    public static function calculate(int $num1, int $num2): ?int
    {
        return $num1 - $num2;
    }
}
