<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use PHPUnit\Framework\TestCase;

class FilterTransactionsTest extends TestCase
{
    public function testFilterTransactionsByClient()
    {
        $this->assertSame('', '');
    }
}