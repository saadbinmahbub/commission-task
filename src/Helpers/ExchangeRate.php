<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;


interface ExchangeRate
{
    public function getRates(): array;
}