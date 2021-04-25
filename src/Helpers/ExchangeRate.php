<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;


interface ExchangeRate
{
    public function getRates(): ExchangeRate;

    public function setRates($rates);

    public function convertToBaseCurrency($from, $amount): float;

    public function convertFromBaseCurrency($to, $amount): float;
}