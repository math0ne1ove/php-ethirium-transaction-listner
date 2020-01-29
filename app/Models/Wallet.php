<?php

namespace App\Models;

use App\Services\EthCurrencyConverter;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    public $table = 'wallet';

    protected $fillable = [
        'address',
        'balance',
    ];

    public function getBalanceInEth()
    {
        return EthCurrencyConverter::convert(
            floatval($this->balance),
            EthCurrencyConverter::WEI,
            EthCurrencyConverter::ETH
        );
    }
}
