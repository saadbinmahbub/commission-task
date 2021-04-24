<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\Transaction;
use Carbon\Carbon;

class FilterTransactions
{
//    private $transactions;
//
//    public function __construct()
//    {
//        $this->transactions = App::get('transactions');
//    }
    public static function findAllWithdrawalsBefore(Transaction $currentTransaction): array
    {
        $transactions = App::get('transactions');
        return array_filter(
            $transactions,
            function ($transaction, $index) use ($currentTransaction) {
                return $currentTransaction->getId() > $index &&
                    $transaction->getOperation = 'withdraw' &&
                        $transaction->getClient() == $currentTransaction->getClient() &&
                        (Carbon::create($currentTransaction->getDate()))
                            ->startOfWeek()->add(2, 'days')->eq(
                                Carbon::create($transaction->getDate())->startOfWeek()->add(2, 'days')
                            );
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}