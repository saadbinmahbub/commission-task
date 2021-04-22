<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This is a sample value in the configuration file
    |
    */

    'name' => '',

    /*
    |--------------------------------------------------------------------------
    | Transaction parser
    |--------------------------------------------------------------------------
    |
    | This value is the name of the class for parsing Transactions
    |
    */

    'transactions_driver' => 'Acme\CommissionTask\Helpers\CSVTransactionFileParser',

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
    ]
];
