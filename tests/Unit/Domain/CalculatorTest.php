<?php

use App\Domain\Calculator\Division;
use App\Domain\Calculator\Minus;
use App\Domain\Calculator\Multiply;
use App\Domain\Calculator\Plus;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testPlusCalculator(): void
    {
        $result = Plus::calculate(2, 3);
        $this->assertEquals(5, $result);
    }

    public function testMinusCalculator(): void
    {
        $result = Minus::calculate(5, 2);
        $this->assertEquals(3, $result);
    }

    public function testMultiplyCalculator(): void
    {
        $result = Multiply::calculate(4, 3);
        $this->assertEquals(12, $result);
    }

    public function testDivisionCalculator(): void
    {
        $result = Division::calculate(10, 2);
        $this->assertEquals(5, $result);
    }

    public function testDivisionByZero(): void
    {
        $result = Division::calculate(10, 0);
        $this->assertNull($result);
    }
}
