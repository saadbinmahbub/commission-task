<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\FilterTransactions;
use Acme\CommissionTask\Service\Transaction;
use PHPUnit\Framework\TestCase;

class FilterTransactionsTest extends TestCase
{
    public function setUp()
    {
        App::bind('config', require './src/config.php');
        // Bind Fake transactions
        App::bind(
            'transactions',
            [
                new Transaction(['2014-12-31', 4, 'private', 'withdraw', 1200.00, 'EUR'], 0),
                new Transaction(['2015-01-01', 4, 'private', 'withdraw', 1000.00, 'EUR'], 1),
                new Transaction(['2016-01-05', 4, 'private', 'withdraw', 1000.00, 'EUR'], 2),
                new Transaction(['2016-01-05', 1, 'private', 'deposit', 200.00, 'EUR'], 3),
                new Transaction(['2016-01-06', 2, 'business', 'withdraw', 300.00, 'EUR'], 4),
                new Transaction(['2016-01-06', 1, 'private', 'withdraw', 30000, 'JPY'], 5),
                new Transaction(['2016-01-07', 1, 'private', 'withdraw', 1000.00, 'EUR'], 6),
                new Transaction(['2016-01-07', 1, 'private', 'withdraw', 100.00, 'USD'], 7),
                new Transaction(['2016-01-10', 1, 'private', 'withdraw', 100.00, 'EUR'], 8),
                new Transaction(['2016-01-10', 2, 'business', 'deposit', 10000.00, 'EUR'], 9),
                new Transaction(['2016-01-10', 3, 'private', 'withdraw', 1000.00, 'EUR'], 10),
                new Transaction(['2016-02-15', 1, 'private', 'withdraw', 300.00, 'EUR'], 11),
                new Transaction(['2016-02-19', 5, 'private', 'withdraw', 3000000, 'JPY'], 12)
            ]
        );
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