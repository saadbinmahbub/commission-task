<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\FilterTransactions;

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
        $filteredTransactions = FilterTransactions::findAllWithdrawalsBefore($transaction);
        $sum = $transaction->getAmount();
        foreach ($filteredTransactions as $filteredTransaction) {
            $sum += $filteredTransaction->getAmount();
        }
        // Subtract 1000EUR from the sum of money
        return $sum;
    }
}