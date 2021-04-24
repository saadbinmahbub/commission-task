<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\Transaction;
use Carbon\Carbon;

class FilterTransactions
{
    /**
     * Return an array of withdrawal transactions
     * that the users made in the week of $currentTransaction
     * @param Transaction $currentTransaction
     * @return array
     * @throws \Exception
     */
    public static function findAllWithdrawalsBefore(Transaction $currentTransaction): array
    {
        $transactions = App::get('transactions');
        return array_filter(
            $transactions,
            function ($transaction, $index) use ($currentTransaction) {
                return $currentTransaction->getId() > $index &&
                    $transaction->getOperation() == 'withdraw' &&
                    $transaction->getClient() == $currentTransaction->getClient() &&
                    // Check if the transactions are in the same week
                    Carbon::parse($currentTransaction->getDate())->startOfWeek()->eq(
                        Carbon::parse($transaction->getDate())->startOfWeek()
                    );
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}