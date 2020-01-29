<?php

namespace App\Models;

use App\Services\EthCurrencyConverter;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
        'from', 'to', 'value', 'hash', 'type',
        'confirm_count', 'block_number'
    ];

    protected $appends = ['valueInEth'];

    public function getValueInEthAttribute()
    {
        return EthCurrencyConverter::convert(
            floatval($this->value),
            EthCurrencyConverter::WEI,
            EthCurrencyConverter::ETH
        );;
    }
}
