<?php


namespace Acme\CommissionTask\Tests;


use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\Transaction;

class Bootstrap
{
    public function bindConfig()
    {
        App::bind(
            'config',
            [
                'base_currency' => 'EUR',
                'transactions_data_driver' => 'Acme\CommissionTask\Helpers\CSVTransactionFileParser',
                'currencies' => [
                    'EUR',
                    'JPY',
                    'USD'
                ],
                'exchange_rates' => [
                    'driver' => 'Acme\CommissionTask\Helpers\APIExchangeRate',
                    'url' => 'http://api.exchangeratesapi.io/v1/',
                    'endpoint' => 'latest',
                    'key' => '3e21f78269b8c12dea3a824dba5f6af9',
                ],
                'private' => [
                    'deposit_rate' => 0.03,
                    'withdrawal_rate' => 0.3,
                    'weekly_withdrawal_amount' => 1000,
                    'weekly_withdrawals' => 3
                ],
                'business' => [
                    'deposit_rate' => 0.03,
                    'withdrawal_rate' => 0.5
                ]
            ]
        );
    }

    public function bindTransactions()
    {
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
                new Transaction(['2016-02-19', 5, 'private', 'withdraw', 3000000, 'JPY'], 12),
                new Transaction(['2016-03-01', 1, 'private', 'withdraw', 100.00, 'USD'], 13),
                new Transaction(['2016-03-01', 1, 'private', 'withdraw', 100.00, 'USD'], 14),
                new Transaction(['2016-03-01', 1, 'private', 'withdraw', 100.00, 'USD'], 15),
                new Transaction(['2016-03-01', 1, 'private', 'withdraw', 100.00, 'USD'], 16),
            ]
        );
    }
}