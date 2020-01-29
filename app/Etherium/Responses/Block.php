<?php

namespace App\Etherium\Responses;

class Block
{
    /** @var string */
    private $hash;

    /** @var string */
    private $number;

    /** @var array|null */
    private $transactions;

    public function __construct(string $hash, string $number, array $transactions = null)
    {
        $this->setHash($hash);
        $this->setNumber($number);
        $this->setTransactions($transactions);
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return array|null
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param array|null $transactions
     */
    public function setTransactions(array $transactions = null): void
    {
        if (!$transactions) {
            return;
        }

        foreach ($transactions as $transaction) {
            $this->transactions[] = new Transaction(
                $transaction['hash'],
                $transaction['from'],
                $transaction['to'],
                $transaction['value'],
                $this->getNumber()
            );
        }
    }
}
