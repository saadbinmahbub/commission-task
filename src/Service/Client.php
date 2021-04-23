<?php


namespace Acme\CommissionTask\Service;


abstract class Client
{
    abstract public function calculateDepositCommissionFee(float $amount): float;

    abstract public function calculateWithdrawalCommissionFee(float $amount): float;
}