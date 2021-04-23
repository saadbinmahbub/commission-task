<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;

class PrivateClient extends Client
{
    public function __construct()
    {
        $this->depositCommissionFeeRate = App::get('config')['private']['deposit_rate'];
        $this->withdrawalCommissionFeeRate = App::get('config')['private']['withdrawal_rate'];
    }

    public function calculateDepositCommissionFee(Transaction $transaction): float
    {
        return $transaction->getAmount() * $this->depositCommissionFeeRate / 100;
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        // TODO: Implement calculateWithdrawalCommissionFee() method.
        return 0.0;
    }
}