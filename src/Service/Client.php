<?php


namespace Acme\CommissionTask\Service;


abstract class Client
{
    protected $depositCommissionFeeRate;
    protected $withdrawalCommissionFeeRate;

    abstract public function calculateDepositCommissionFee(Transaction $transaction): float;

    abstract public function calculateWithdrawalCommissionFee(Transaction $transaction): float;
}