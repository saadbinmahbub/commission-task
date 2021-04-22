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
 * Bind Exchange Rates API instance in the application
 */
$exchangeRatesAPIClass = (App::get('config'))['exchange_rates_api_driver'];
App::bind(
    'exchange_rates',
    new $exchangeRatesAPIClass(
        App::get('config')['exchange_rates_api_url'],
        App::get('config')['exchange_rates_api_key']
    )
);