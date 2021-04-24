<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Service;

use Acme\CommissionTask\App;

class Transaction
{
    private $id;
    protected $date;
    protected $client;
    protected $clientType;
    protected $operation;
    protected $amount;
    protected $currency;

    public function __construct($transaction, int $id)
    {
        $this->id = $id;
        $this->date = $transaction[0];
        $this->client = (int) $transaction[1];
        $this->clientType = $transaction[2];
        $this->operation = $transaction[3];
        $this->amount = (float) $transaction[4];
        $this->currency = $transaction[5];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $client
     */
    public function setClient(int $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getClientType()
    {
        return $this->clientType;
    }

    /**
     * @param mixed $clientType
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;
    }

    /**
     * @return mixed
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param mixed $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function isBaseCurrency(): bool
    {
        return $this->getCurrency() === App::get('config')['base_currency'];
    }
}