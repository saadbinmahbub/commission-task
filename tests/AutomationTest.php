<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests;

use PHPUnit\Framework\TestCase;

class AutomationTest extends TestCase
{
    public function testAutomation()
    {
        $argv[1] = 'transactions.csv';
        $commissions = require 'index.php';
        $this->assertCount(13, $commissions);
        foreach ($commissions as $commission) {
            $this->assertGreaterThanOrEqual(0, $commission);
        }
    }
}