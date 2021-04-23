<?php


namespace Acme\CommissionTask\Service;


class BusinessClient extends Client
{
    public function calculateDepositCommissionFee(Transaction $transaction): float
    {
        // TODO: Implement calculateDepositCommissionFee() method.
        return 0.0;
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        // TODO: Implement calculateWithdrawalCommissionFee() method.
        return 0.0;
    }
}