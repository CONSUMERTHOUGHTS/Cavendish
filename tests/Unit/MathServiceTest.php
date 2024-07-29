<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\MathService;

class MathServiceTest extends TestCase
{
    public function testAdd()
    {
        $mathService = new MathService();
        $this->assertEquals(5, $mathService->add(2, 3));
    }

    public function testSubtract()
    {
        $mathService = new MathService();
        $this->assertEquals(1, $mathService->subtract(3, 2));
    }

    public function testMultiply()
    {
        $mathService = new MathService();
        $this->assertEquals(6, $mathService->multiply(2, 3));
    }

    public function testDivide()
    {
        $mathService = new MathService();
        $this->assertEquals(2, $mathService->divide(6, 3));
    }

    public function testDivideByZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $mathService = new MathService();
        $mathService->divide(6, 0);
    }
}
