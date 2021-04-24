<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\FilterTransactions;

class PrivateClient extends Client
{
    protected $weeklyWithdrawalAmount;
    protected $weeklyWithdrawals;

    public function __construct()
    {
        $this->depositCommissionFeeRate = App::get('config')['private']['deposit_rate'];
        $this->withdrawalCommissionFeeRate = App::get('config')['private']['withdrawal_rate'];
        $this->weeklyWithdrawalAmount = App::get('config')['private']['weekly_withdrawal_amount'];
        $this->weeklyWithdrawals = App::get('config')['private']['weekly_withdrawals'];
    }

    public function calculateDepositCommissionFee(Transaction $transaction): float
    {
        return $transaction->getAmount() * $this->depositCommissionFeeRate / 100;
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        $filteredTransactions = FilterTransactions::findAllWithdrawalsBefore($transaction);
        if (count($filteredTransactions) > $this->weeklyWithdrawals) {
            return $transaction->getAmount() * $this->depositCommissionFeeRate / 100;
        }
        $sum = (float) $transaction->getAmount();
        foreach ($filteredTransactions as $filteredTransaction) {
            $sum += (float) $filteredTransaction->getAmount();
        }
        $sum -= App::get('exchange_rates')->convert(
            $transaction->getCurrency(),
            $this->weeklyWithdrawalAmount
        );

        return $sum > 0 ? $sum * $this->depositCommissionFeeRate / 100 : 0.0;
    }
}