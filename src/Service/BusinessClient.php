<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;

class BusinessClient extends Client
{
    public function __construct()
    {
        $this->depositCommissionFeeRate = App::get('config')['business']['deposit_rate'];
        $this->withdrawalCommissionFeeRate = App::get('config')['business']['withdrawal_rate'];
    }

    public function calculateDepositCommissionFee(Transaction $transaction): float
    {
        return $transaction->getAmount() * $this->depositCommissionFeeRate / 100;
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        // TODO: Implement calculateWithdrawalCommissionFee() method.
        return $transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100;
    }
}