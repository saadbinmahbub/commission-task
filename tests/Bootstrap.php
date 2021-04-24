<?php


namespace Acme\CommissionTask\Tests;


class Bootstrap
{
    public function bootstrap()
    {
        $argv[1] = 'transactions.csv';
        require './src/bootstrap.php';
    }
}