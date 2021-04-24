<?php


namespace Acme\CommissionTask;


use Acme\CommissionTask\Service\ClientFactory;

class Main
{
    public function main()
    {
        $commissions = [];
        $transactions = App::get('transactions');
        foreach ($transactions as $transaction) {
            $client = (new ClientFactory())->getClient($transaction->getClientType());
            if ($transaction->getOperation() == 'deposit') {
                array_push($commissions, $client->calculateDepositCommissionFee($transaction));
            } else {
                array_push($commissions, $client->calculateWithdrawalCommissionFee($transaction));
            }
        }
        return $commissions;
    }
}