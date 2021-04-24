<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\FilterTransactions;
use Acme\CommissionTask\Helpers\Math;

class PrivateClient extends Client
{
    protected $weeklyWithdrawalAmount;
    protected $weeklyWithdrawals;
    protected $exchangeRate;

    public function __construct()
    {
        $this->depositCommissionFeeRate = App::get('config')['private']['deposit_rate'];
        $this->withdrawalCommissionFeeRate = App::get('config')['private']['withdrawal_rate'];
        $this->weeklyWithdrawalAmount = App::get('config')['private']['weekly_withdrawal_amount'];
        $this->weeklyWithdrawals = App::get('config')['private']['weekly_withdrawals'];
        $this->exchangeRate = App::get('exchange_rates');
    }

    public function calculateDepositCommissionFee(Transaction $transaction): float
    {
        return Math::roundUp($transaction->getAmount() * $this->depositCommissionFeeRate / 100, 2);
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        $filteredTransactions = FilterTransactions::findAllWithdrawalsBefore($transaction);
        // More than 3 transactions
        if (count($filteredTransactions) > $this->weeklyWithdrawals) {
            return Math::roundUp($transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100, 2);
        }
        $sumPreviousTransactionsInBaseCurrency = 0;
        foreach ($filteredTransactions as $filteredTransaction) {
            $sumPreviousTransactionsInBaseCurrency += $this->exchangeRate->convertToBaseCurrency(
                $filteredTransaction->getCurrency(),
                $filteredTransaction->getAmount()
            );
        }
        $convertedAmount = $this->exchangeRate->convertToBaseCurrency(
            $transaction->getCurrency(),
            $transaction->getAmount()
        );
        // Check $sumPreviousTransactionsInBaseCurrency > 1000 ? return commission on current amount
        if ($sumPreviousTransactionsInBaseCurrency > $this->weeklyWithdrawalAmount) {
            return Math::roundUp($transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100, 2);
        } else {
            $sum = $sumPreviousTransactionsInBaseCurrency + $convertedAmount;
            if ($sum > $this->weeklyWithdrawalAmount) {
                $commissionable = $sum - $this->weeklyWithdrawalAmount;
                $convertedComissionable = $this->exchangeRate->convertFromBaseCurrency($transaction->getCurrency(), $commissionable);
                return Math::roundUp($convertedComissionable * $this->withdrawalCommissionFeeRate / 100, 2);
            }
        }
        return 0.0;
    }
}