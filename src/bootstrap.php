<?php

use Acme\CommissionTask\App;

/**
 * Bind config.php file
 */
App::bind('config', require 'config.php');
/**
 * Bind Transactions in memory
 */
$transactionParserClass = App::get('config')['transactions_driver'];
$transactionParser      = new $transactionParserClass();
App::bind('transactions', $transactionParser->parse($argv[1]));
