<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use PHPUnit\Framework\TestCase;
use Acme\CommissionTask\Service\Math;

class MathTest extends TestCase
{
    public function testRoundUp()
    {
        $rounded = Math::roundUp(0.023, 2);
        $this->assertSame('0.03', $rounded);
    }
}
