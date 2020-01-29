<?php


namespace App\Etherium\Responses;


class Transaction
{
    private $model = \App\Models\Transaction::class;

    /** @var string|null */
    private $from = null;

    /** @var string|null */
    private $to = null;

    /** @var string|null */
    private $value = null;

    /** @var string */
    private $hash;

    /** @var string */
    private $blockNumber;

    public function __construct(string $hash, string $from, string $to, string $value, string $blockNumber)
    {
        $this->setHash($hash);
        $this->setFrom($from);
        $this->setTo($to);
        $this->setValue($value);
        $this->setBlockNumber($blockNumber);
    }

    /**
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param string|null $from
     */
    public function setFrom(?string $from): void
    {
        $this->from = $from;
    }

    /**
     * @return string|null
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * @param string|null $to
     */
    public function setTo(?string $to): void
    {
        $this->to = $to;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
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
    public function getBlockNumber(): string
    {
        return $this->blockNumber;
    }

    /**
     * @param string $blockNumber
     */
    public function setBlockNumber(string $blockNumber): void
    {
        $this->blockNumber = $blockNumber;
    }

    public function getModel()
    {
        /** @var \App\Models\Transaction $transaction */
        $transaction = new $this->model([
            'hash' => $this->getHash(),
            'value' => $this->getValueInWei(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'block_number' => $this->getBlockNumber(),
        ]);

        return $transaction;
    }

    public function getValueInWei()
    {
        return $this->value ? hexdec($this->value) : 0;
    }
}
