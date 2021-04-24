<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use Acme\CommissionTask\Helpers\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testRoundUp()
    {
        $rounded = Math::roundUp(0.023);
        $this->assertSame(0.03, $rounded);
        $rounded = Math::roundUp(0.0001);
        $this->assertSame(0.01, $rounded);
    }
}
