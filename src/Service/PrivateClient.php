<?php


namespace Acme\CommissionTask\Service;


use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\FilterTransactions;

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
        return $transaction->getAmount() * $this->depositCommissionFeeRate / 100;
    }

    public function calculateWithdrawalCommissionFee(Transaction $transaction): float
    {
        $filteredTransactions = FilterTransactions::findAllWithdrawalsBefore($transaction);
        // More than 3 transactions
        if (count($filteredTransactions) > $this->weeklyWithdrawals) {
            return $transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100;
        }
        $sumPreviousTransactionsInBaseCurrency = 0;
        foreach ($filteredTransactions as $filteredTransaction) {
            $sumPreviousTransactionsInBaseCurrency += (float)$this->exchangeRate->convert(
                App::get('config')['base_currency'],
                $filteredTransaction->getAmount()
            );
        }
        var_dump($sumPreviousTransactionsInBaseCurrency);
        // Client already crossed free transaction amount
        if ($sumPreviousTransactionsInBaseCurrency > $this->weeklyWithdrawalAmount) {
            return $transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100;
        } else {
//            $commissionable = ($sumPreviousTransactions + $transaction->getAmount()) - $this->exchangeRate->convert(
//                    $transaction->getCurrency(),
//                    $this->weeklyWithdrawalAmount
//                );
//            return $commissionable > 0 ? $commissionable * $this->withdrawalCommissionFeeRate / 100 : 0.0;
        }
        return 0.0;
    }
}