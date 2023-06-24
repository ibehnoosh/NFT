<?php

namespace App\Domain\Calculator;

use App\Domain\Contracts\CalculatorInterface;

class Division  implements CalculatorInterface
{
    public static function calculate(int $num1, int $num2): ?int
    {
        if ($num2 !== 0) {
            return intval($num1 / $num2);
        }

        return null;
    }
}