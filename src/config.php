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

    'currencies'                  => [
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
    'exchange_rates_api_driver'   => 'Acme\CommissionTask\Helpers\APICurrencyExchangeRate',
    'exchange_rates_api_url'      => 'https://api.exchangeratesapi.io/v1/',
    'exchange_rates_api_endpoint' => 'latest',
    'exchange_rates_api_key'      => '3e21f78269b8c12dea3a824dba5f6af9'
];
