<?php

namespace App\Adapter\Transaction;

use Doctrine\DBAL\TransactionIsolationLevel;
use Doctrine\ORM\EntityManagerInterface;

class TransactionAdapter implements TransactionAdapterInterface
{

    public function __construct(
        private readonly EntityManagerInterface $_em
    )
    {
    }


    public function run(
        callable $callback,
        int $isolation = TransactionIsolationLevel::READ_COMMITTED,
        int $retryCount = 0
    ): mixed {
        $connection = $this->_em->getConnection();
        $connection->setTransactionIsolation($isolation);

        $nowRetryCount = 0;

        $lastError = null;

        $connection->beginTransaction();
        do {
            try {
                $result = $callback();

                $this->_em->flush();

                return $result;
            } catch (\Exception $exception) {
                $lastError = $exception;
            }
        } while ($nowRetryCount < $retryCount);

        $connection->rollBack();
        throw $lastError;
    }
}
