<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;


interface TransactionFileParser
{
    public function parse(string $file): array;
}