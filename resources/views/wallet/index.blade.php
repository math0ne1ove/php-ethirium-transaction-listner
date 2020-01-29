@extends('layout')

@section('content')
    @include('common.wallet-item', ['header' => true, 'address' => 'Address', 'balance' => 'Balance', 'id' => 'ID'])
    @foreach($wallets as $key => $wallet)
        @include('common.wallet-item', ['header' => false, 'address' => $wallet->address, 'balance' => $wallet->getBalanceInEth(), 'id' => $wallet->id])
    @endforeach
@endsection

