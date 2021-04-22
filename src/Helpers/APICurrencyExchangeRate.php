<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

class APICurrencyExchangeRate implements CurrencyExchangeRate
{
    protected $url;
    protected $accessKey;

    public function __construct($url, $accessKey)
    {
        $this->url       = $url;
        $this->accessKey = $accessKey;
    }

    public function convert(string $from, string $to, $amount): float
    {
//        $ch = curl_init(
//            $this->url .
//            '?access_key=' .
//            $this->accessKey .
//            '&from=' .
//            $from .
//            '&to=' .
//            $to .
//            '&amount=' .
//            $amount .
//            ''
//        );
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//        $json = curl_exec($ch);
//        curl_close($ch);
//        $conversionResult = json_decode($json, true);
//
//        return $conversionResult['result'];
    }
}