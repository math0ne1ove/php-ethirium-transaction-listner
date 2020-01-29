<?php

namespace App\Etherium;

interface EtheriumProvider
{
    /**
     * @param string $address
     * @return float
     */
    public function getBalance(string $address): float;

    /**
     * @param string $hash
     * @return array
     */
    public function getBlock(string $hash): array;
}
