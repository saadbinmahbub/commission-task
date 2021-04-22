<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;


class APICurrencyExchangeRate implements CurrencyExchangeRate
{

    public function convert(string $from, string $to, $amount): float
    {
        // TODO: Implement convert() method.
        return 0.0;
    }
}