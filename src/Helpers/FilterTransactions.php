<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\App;

class FilterTransactions
{
    private $transactions;

    public function __construct()
    {
        $this->transactions = App::get('transactions');
    }

    public function filterTransactionsByClient(int $client): array
    {
        return array_filter(
            $this->transactions,
            function ($transaction) {
                return $transaction->client == 4;
            }
        );
    }
}