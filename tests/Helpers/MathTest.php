<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use Acme\CommissionTask\Helpers\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testRoundUp()
    {
        $rounded = Math::roundUp(0.023, 2);
        $this->assertSame('0.03', $rounded);
        $rounded = Math::roundUp(0.0001, 2);
        $this->assertSame('0.01', $rounded);
        $rounded = Math::roundUp(8647.4888, 2);
        $this->assertSame('8647.49', $rounded);
    }
}
