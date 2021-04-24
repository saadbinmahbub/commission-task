<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use Acme\CommissionTask\Helpers\FilterTransactions;
use Acme\CommissionTask\Service\Transaction;
use Acme\CommissionTask\Tests\Bootstrap;
use PHPUnit\Framework\TestCase;

class FilterTransactionsTest extends TestCase
{
    public function setUp()
    {
        $bootstrap = new Bootstrap();
        $bootstrap->bindConfig();
        $bootstrap->bindTransactions();
    }

    public function testFindsAllOfAGivenUserTransactionsBeforeAGivenTransaction()
    {
        $filtered = FilterTransactions::findAllWithdrawalsBefore(
            new Transaction(['2015-01-01', 4, 'private', 'withdraw', 1000.00, 'EUR'], 1)
        );
        $this->assertEquals(
            [
                new Transaction(['2014-12-31', 4, 'private', 'withdraw', 1200.00, 'EUR'], 0)
            ],
            $filtered
        );
    }

    public function testReturnsEmptyArrayIfUserHasNoTransactionsInTheWeek()
    {
        $filtered = FilterTransactions::findAllWithdrawalsBefore(
            new Transaction(['2016-01-05', 4, 'private', 'withdraw', 1000.00, 'EUR'], 2)
        );
        $this->assertEquals(
            [],
            $filtered
        );
    }
}