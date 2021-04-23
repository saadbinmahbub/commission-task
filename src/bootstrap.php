<?php

use Acme\CommissionTask\App;

/**
 * Bind config.php file
 */
App::bind('config', require 'config.php');
/**
 * Bind Transactions in memory
 */
$transactionParserClass = (App::get('config'))['transactions_data_driver'];
App::bind(
    'transactions',
    (new $transactionParserClass())->parse($argv[1])
);

/**
 * Bind Exchange Rates to the application
 * It's better to call the API only once during the lifetime of the application
 */
$exchangeRatesDriverClass = (App::get('config'))['exchange_rates_api_driver'];
App::bind(
    'exchange_rates',
    (new $exchangeRatesDriverClass())->getRates()
);
