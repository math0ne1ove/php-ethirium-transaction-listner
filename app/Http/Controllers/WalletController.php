<?php

namespace App\Http\Controllers;

use App\Facades\Etherium;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WalletController extends Controller
{
    public function index()
    {
        return view('wallet.index', [
            'wallets' => Wallet::all()
        ]);
    }

    public function create()
    {
        return view('wallet.create');
    }

    public function store(Request $request)
    {
        $address = strtolower($request->get('address', ''));

        try {
            $balance = Etherium::getBalance($address);
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect()->route('wallet');
        }

        $wallet = new Wallet([
            'address' => $address,
            'balance' => $balance
        ]);

        $wallet->save();

        Redis::connection()->set('eth_wallet_' . $address, $wallet->id);

        $request->session()->flash('success', 'Wallet created');

        return redirect()->route('wallet');
    }

    public function delete(Request $request, Wallet $wallet)
    {
        try {
            $address = $wallet->address;

            $wallet->delete();

            Redis::connection()->del(['eth_wallet_' . $address]);
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect()->route('wallet');
        }

        $request->session()->flash('success', 'Wallet deleted');

        return redirect()->route('wallet');
    }
}
