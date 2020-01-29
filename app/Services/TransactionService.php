<?php

namespace App\Services;

use App\Etherium\Responses\Block;
use App\Etherium\Responses\Transaction;
use App\Facades\Etherium;
use App\Models\Transaction as TransactionModel;
use App\Models\Wallet;
use Illuminate\Support\Facades\Redis;

class TransactionService
{
    /** @var Block */
    private $block;

    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function parseTransactions()
    {
        //number of blocks since the block which the transaction was added
        TransactionModel::query()->increment('confirm_count', 1, [
            'block_number' => $this->block->getNumber()
        ]);

        if (!($transactions = $this->block->getTransactions())) {
            return;
        }

        /** @var Transaction  $transaction */
        foreach ($transactions as $transaction) {
            list($fromAddressExistIdDB, $toAddressExistsInDB) = $this->checkWalletExists(
                $transaction->getFrom(),
                $transaction->getTo()
            );

            if ($fromAddressExistIdDB || $toAddressExistsInDB) {
                $this->saveTransaction($transaction);
                //increase wallet balance after transaction was added
                $this->updateWalletbalance($transaction->getFrom());
            }
        }
    }

    private function saveTransaction(Transaction $transaction)
    {
        $transactionModel = $transaction->getModel();
        $transactionModel->save();

        return $transactionModel;
    }

    private function updateWalletBalance(string $address)
    {
        $balance = Etherium::getBalance($address);
        Wallet::query()->where('address', $address)->update(['balance' => $balance]);
    }

    private function checkWalletExists(string $addressFrom = null, string $addressTo = null)
    {
        $fromAddressExistIdDB = $addressFrom ?
            Redis::connection()->exists('eth_wallet_' . $addressFrom) :
            false;

        $toAddressExistsInDB = $addressTo ?
            Redis::connection()->exists('eth_wallet_' . $addressTo) :
            false;

        return [$fromAddressExistIdDB, $toAddressExistsInDB];
    }
}
