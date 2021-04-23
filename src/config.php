<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Base Currency
    |--------------------------------------------------------------------------
    |
    | Configuration for the application's base currency
    |
    */

    'base_currency' => 'EUR',

    /*
    |--------------------------------------------------------------------------
    | Transaction parser
    |--------------------------------------------------------------------------
    |
    | This value is the name of the class for parsing Transactions
    |
    */

    'transactions_data_driver' => 'Acme\CommissionTask\Helpers\CSVTransactionFileParser',

    /*
    |--------------------------------------------------------------------------
    | Currencies
    |--------------------------------------------------------------------------
    |
    | Array of currencies the system will handle,
    | add to the array if new currency needs to be added
    |
    */

    'currencies' => [
        'EUR',
        'JPY',
        'USD'
    ],

    /*
    |--------------------------------------------------------------------------
    | Exchange Rate API
    |--------------------------------------------------------------------------
    |
    | Exchange rate api variables
    |
    */
    'exchange_rates' => [
        'driver' => 'Acme\CommissionTask\Helpers\APICurrencyExchangeRate',
        'url' => 'http://api.exchangeratesapi.io/v1/',
        'endpoint' => 'latest',
        'key' => '3e21f78269b8c12dea3a824dba5f6af9',
    ],

    /*
    |--------------------------------------------------------------------------
    | Transaction rules
    |--------------------------------------------------------------------------
    |
    | Configuration for transaction rules:
    | Deposit commission percentage for private clients
    | Deposit commission percentage for business clients
    | Withdrawal commission percentage for private clients
    | Withdrawal commission percentage for private clients
    |
    */
    'private' => [
        'deposit_commission' => 0.03,
        'withdrawal_commission' => 0.3
    ],
    'business' => [
        'deposit_commission' => 0.03,
        'withdrawal_commission' => 0.5
    ]
];
