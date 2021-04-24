<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\Service\Transaction;

class CSVTransactionFileParser implements TransactionFileParser
{
    public function parse(string $file): array
    {
        $transactions = [];
        $handle = fopen($file, 'r') or die("Could not open file {$file}");
        for ($i = 0; $row = fgetcsv($handle); ++$i) {
            if (count($row) > 0) {
                array_push($transactions, new Transaction($row, $i));
            }
        }
        fclose($handle);

        return $transactions;
    }
}