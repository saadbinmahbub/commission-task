<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\Math;

class BusinessClient extends Client
{
    public function __construct()
    {
        $this->depositCommissionFeeRate = App::get('config')['business']['deposit_rate'];
        $this->withdrawalCommissionFeeRate = App::get('config')['business']['withdrawal_rate'];
    }

    public function calculateDepositCommissionFee(Transaction $transaction): float
    {
        return Math::roundUp(
            $transaction->getAmount() * $this->depositCommissionFeeRate / 100,
            2
        );
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        return Math::roundUp(
            $transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100,
            2
        );
    }
}