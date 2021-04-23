<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Service;

class Transaction
{
    protected $date;
    protected $client;
    protected $clientType;
    protected $operation;
    protected $amount;
    protected $currency;

    public function __construct($transaction)
    {
        $this->date = $transaction[0];
        $this->client = $transaction[1];
        $this->clientType = $transaction[2];
        $this->operation = $transaction[3];
        $this->amount = $transaction[4];
        $this->currency = $transaction[5];
    }
}