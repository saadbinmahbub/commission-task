<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;


interface CurrencyExchangeRate
{
    public function getRates(): array;
}