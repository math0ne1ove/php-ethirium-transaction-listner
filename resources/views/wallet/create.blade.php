@extends('layout')

@section('content')
    <form method="POST" action="{{ route('wallet.store') }}">
        @csrf
        <v-text-field
            label="Address"
            name="address"
            required
        ></v-text-field>
        <v-btn type="submit" class="mr-4">create</v-btn>
    </form>
@endsection
