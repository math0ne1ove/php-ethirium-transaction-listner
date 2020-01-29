<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function newList()
    {
        return response()->json(['transactions' => Transaction::all()->toArray()]);
    }
}
