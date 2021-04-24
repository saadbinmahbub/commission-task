<?php

use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\ClientFactory;

require 'vendor/autoload.php';
require 'src/bootstrap.php';

if (defined('PHPUNIT_COMMISSION_TESTSUITE') && PHPUNIT_COMMISSION_TESTSUITE) {
    return 'hello';
} else {
    $transactions = App::get('transactions');
    foreach ($transactions as $transaction) {
        $client = (new ClientFactory())->getClient($transaction->getClientType());
        if ($transaction->getOperation() == 'deposit') {
            echo $client->calculateDepositCommissionFee($transaction) . "\n";
        } else {
            echo $client->calculateWithdrawalCommissionFee($transaction) . "\n";
        }
    }
}