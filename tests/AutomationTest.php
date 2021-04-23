<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests;

use PHPUnit\Framework\TestCase;

class AutomationTest extends TestCase
{
    public function testAutomation()
    {
        $argv[1] = 'transactions.csv';
        $output = require 'index.php';
        $this->assertEquals('hello', $output);
    }
}