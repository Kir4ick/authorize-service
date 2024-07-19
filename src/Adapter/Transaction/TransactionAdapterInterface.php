<?php

namespace App\Adapter\Transaction;

use Doctrine\DBAL\TransactionIsolationLevel;

interface TransactionAdapterInterface
{
    public function run(
        callable $callback,
        int $isolation = TransactionIsolationLevel::READ_COMMITTED,
        int $retryCount = 0
    ): mixed;

}
