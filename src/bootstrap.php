<?php

use Acme\CommissionTask\App;

App::bind('config', require 'config.php');
$transactionParserClass = App::get('config')['transactions_driver'];
$transactionParser      = new $transactionParserClass();
App::bind('transactions', $transactionParser->parse('file'));
