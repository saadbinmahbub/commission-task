<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\APICurrencyExchangeRate;
use PHPUnit\Framework\TestCase;

class APICurrencyExchangeRateTest extends TestCase
{
    private $apiCurrencyExchangeRate;

    public function setUp()
    {
        App::bind('config', require './src/config.php');
        $this->apiCurrencyExchangeRate = new APICurrencyExchangeRate(
            App::get('config')['exchange_rates_api_url'],
            App::get('config')['exchange_rates_api_endpoint'],
            App::get('config')['exchange_rates_api_key']
        );
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