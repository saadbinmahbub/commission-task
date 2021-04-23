<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\App;

class APICurrencyExchangeRate implements CurrencyExchangeRate
{
    protected $url;
    protected $accessKey;
    protected $endpoint;
    protected $baseCurrency;
    protected $supportedCurrencies;

    public function __construct()
    {
        $this->url = App::get('config')['exchange_rates']['url'];
        $this->accessKey = App::get('config')['exchange_rates']['key'];
        $this->endpoint = App::get('config')['exchange_rates']['endpoint'];
        $this->baseCurrency = App::get('config')['base_currency'];
        $this->supportedCurrencies = App::get('config')['currencies'];
    }

    public function getRates(): array
    {
        $ch = curl_init(
            $this->url .
            $this->endpoint .
            '?access_key=' .
            $this->accessKey .
            '&base=' .
            $this->baseCurrency .
            '&symbols=' .
            implode(',', $this->supportedCurrencies)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);
        return json_decode($json, true);
    }
}