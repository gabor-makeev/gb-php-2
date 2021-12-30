<?php

require_once basename(__DIR__) . '/../vendor/autoload.php';
require_once basename(__DIR__) . '/../src/Math.php';

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    /**
     * @var Math
     */
    private $mathObj;

    /**
     * @dataProvider mathSumProvider
     */
    public function testMathSum($a, $b, $c)
    {
        $this->assertEquals($a, $this->mathObj->sum($b, $c));
    }

    /**
     * @dataProvider mathMulProvider
     */
    public function testMathMul($a, $b, $c)
    {
        $this->assertEquals($a, $this->mathObj->mul($b, $c));
    }

    public function mathSumProvider(): array
    {
        return [
            [
                4, 2, 2
            ],
            [
                6, 3, 3
            ],
            [
                10, 5, 5
            ],
            [
                30, 15, 15
            ]
        ];
    }

    public function mathMulProvider() : array
    {
        return [
            [
                15, 5, 3
            ],
            [
                36, 4, 9
            ]
        ];
    }

    public function setUp(): void
    {
        $this->mathObj = new Math();
    }
}