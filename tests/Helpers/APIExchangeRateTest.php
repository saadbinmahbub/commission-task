<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\APIExchangeRate;
use Exception;
use PHPUnit\Framework\TestCase;

class APIExchangeRateTest extends TestCase
{
    private $apiCurrencyExchangeRate;
    private $baseCurrency;

    public function setUp()
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
        $this->apiCurrencyExchangeRate = (new APIExchangeRate())->getRates();
        $this->baseCurrency = App::get('config')['base_currency'];
    }

    public function testConvertsBaseCurrency()
    {
        $this->assertEquals(
            1000.00,
            $this->apiCurrencyExchangeRate->convertToBaseCurrency($this->baseCurrency, 1000.00)
        );
    }

    public function testThrowsExceptionIfCurrencyIsNotSupportedInConvertFromBaseCurrency()
    {
        $this->expectException(Exception::class);
        $this->apiCurrencyExchangeRate->convertToBaseCurrency('ZZZ', 1000.00);
    }

    public function testConvertFromBaseCurrency()
    {
        $this->assertEquals(
            1000.00,
            $this->apiCurrencyExchangeRate->convertFromBaseCurrency($this->baseCurrency, 1000.00)
        );
    }

    public function testThrowsExceptionIfCurrencyIsNotSupportedInConvertToBaseCurrency()
    {
        $this->expectException(Exception::class);
        $this->apiCurrencyExchangeRate->convertFromBaseCurrency('ZZZ', 1000.00);
    }
}