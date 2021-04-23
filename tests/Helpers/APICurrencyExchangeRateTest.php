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
        App::bind('config', require './src/Config.php');
        $this->apiCurrencyExchangeRate = new APICurrencyExchangeRate(
            App::get('config')['exchange_rates']['url'],
            App::get('config')['exchange_rates']['endpoint'],
            App::get('config')['exchange_rates']['key']
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