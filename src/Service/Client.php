<?php


namespace Acme\CommissionTask\Service;


abstract class Client
{
    abstract public function calculateDepositCommissionFee(): float;

    abstract public function calculateWithdrawalCommissionFee(): float;
}