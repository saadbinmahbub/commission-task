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
        App::bind('config', require './src/config.php');
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