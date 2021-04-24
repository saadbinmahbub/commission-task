<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

use Acme\CommissionTask\Service\Transaction;
use Exception;

class CSVTransactionFileParser implements TransactionFileParser
{
    /**
     * @param string $file
     * @return array
     * @throws Exception
     */
    public function parse(string $file): array
    {
        if (!file_exists($file)) {
            throw new Exception('File {$file} not found.');
        }
        $handle = fopen($file, 'r') or die("Could not open file {$file}");
        $transactions = [];
        for ($i = 0; $row = fgetcsv($handle); ++$i) {
            if (count($row) > 0) {
                array_push($transactions, new Transaction($row, $i));
            }
        }
        fclose($handle);

        return $transactions;
    }
}