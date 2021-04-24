<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Helpers;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\APIExchangeRate;
use PHPUnit\Framework\TestCase;

class APIExchangeRateTest extends TestCase
{
    private $apiCurrencyExchangeRate;

    public function setUp()
    {
        App::bind('config', require './src/config.php');
        $this->apiCurrencyExchangeRate = new APIExchangeRate();
    }

    public function testGetLatestRates()
    {
        $rates = $this->apiCurrencyExchangeRate->getRates();
        $baseCurrency = App::get('config')['base_currency'];
        $this->assertSame(
            1,
            $rates['rates'][$baseCurrency]
        );
    }
}