<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\App;
use Exception;

class APIExchangeRate implements ExchangeRate
{
    protected $url;
    protected $accessKey;
    protected $endpoint;
    protected $baseCurrency;
    protected $supportedCurrencies;
    protected $rates;

    public function __construct()
    {
        $this->url = App::get('config')['exchange_rates']['url'];
        $this->accessKey = App::get('config')['exchange_rates']['key'];
        $this->endpoint = App::get('config')['exchange_rates']['endpoint'];
        $this->baseCurrency = App::get('config')['base_currency'];
        $this->supportedCurrencies = App::get('config')['currencies'];
    }

    public function getRates(): ExchangeRate
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
        $this->rates = json_decode($json, true);
        return $this;
    }

    /**
     * @param mixed $rates
     */
    public function setRates($rates)
    {
        $this->rates = $rates;
    }

    /**
     * @param $from
     * @param $amount
     * @return float
     * @throws Exception
     */
    public function convertToBaseCurrency($from, $amount): float
    {
        if (!array_key_exists($from, $this->rates['rates'])) {
            throw new Exception("Currency {$from} not supported");
        }
        return $amount / $this->rates['rates'][$from];
    }

    /**
     * @param $to
     * @param $amount
     * @return float
     * @throws Exception
     */
    public function convertFromBaseCurrency($to, $amount): float
    {
        if (!array_key_exists($to, $this->rates['rates'])) {
            throw new Exception("Currency {$to} not supported");
        }
        return $amount * $this->rates['rates'][$to];
    }
}