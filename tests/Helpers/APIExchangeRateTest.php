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

    public function setUp()
    {
        App::bind('config', require './src/config.php');
        $this->apiCurrencyExchangeRate = (new APIExchangeRate())->getRates();
    }

    public function testConvertsBaseCurrency()
    {
        $this->assertEquals(
            1000.00,
            $this->apiCurrencyExchangeRate->convert('EUR', 1000.00)
        );
    }

    public function testThrowsExceptionIfCurrencyIsNotSupported()
    {
        $this->expectException(Exception::class);
        $this->apiCurrencyExchangeRate->convert('ZZZ', 1000.00);
    }
}