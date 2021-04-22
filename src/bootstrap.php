<?php

use Acme\CommissionTask\App;

App::bind('config', require 'config.php');

$transactionsDriver = new ReflectionClass(App::get('config')['transactions_driver']);
$transactionParser  = $transactionsDriver->newInstance();
App::bind('transactions', $transactionParser->parse());
