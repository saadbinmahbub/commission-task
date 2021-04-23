<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\Helpers\CSVTransactionFileParser;
use Acme\CommissionTask\Service\Transaction;
use PHPUnit\Framework\TestCase;

class CSVTransactionFileParserTest extends TestCase
{
    private $csvTransactionFileParser;
    private $csvFile;
    private $expectedTransactionArray;

    public function setUp()
    {
        $this->csvTransactionFileParser = new CSVTransactionFileParser();
        $this->csvFile = 'transactions.csv';
        $this->expectedTransactionArray = [
            new Transaction(['2014-12-31', 4, 'private', 'withdraw', 1200.00, 'EUR']),
            new Transaction(['2015-01-01', 4, 'private', 'withdraw', 1000.00, 'EUR']),
            new Transaction(['2016-01-05', 4, 'private', 'withdraw', 1000.00, 'EUR']),
            new Transaction(['2016-01-05', 1, 'private', 'deposit', 200.00, 'EUR']),
            new Transaction(['2016-01-06', 2, 'business', 'withdraw', 300.00, 'EUR']),
            new Transaction(['2016-01-06', 1, 'private', 'withdraw', 30000, 'JPY']),
            new Transaction(['2016-01-07', 1, 'private', 'withdraw', 1000.00, 'EUR']),
            new Transaction(['2016-01-07', 1, 'private', 'withdraw', 100.00, 'USD']),
            new Transaction(['2016-01-10', 1, 'private', 'withdraw', 100.00, 'EUR']),
            new Transaction(['2016-01-10', 2, 'business', 'deposit', 10000.00, 'EUR']),
            new Transaction(['2016-01-10', 3, 'private', 'withdraw', 1000.00, 'EUR']),
            new Transaction(['2016-02-15', 1, 'private', 'withdraw', 300.00, 'EUR']),
            new Transaction(['2016-02-19', 5, 'private', 'withdraw', 3000000, 'JPY'])
        ];
    }

    public function testReturnsArrayOfTransactionsFromCSVFile()
    {
        $transactions = $this->csvTransactionFileParser->parse($this->csvFile);
        $this->assertEquals($this->expectedTransactionArray, $transactions);
    }
}