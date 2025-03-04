@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address_edit.css') }}">
@endsection

@section('content')
<div class="container">
        <h1>住所の変更</h1>
        <form action="{{ route('address.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="postal_code">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code" required>

            <label for="address">住所</label>
            <input type="text" id="address" name="address" required>

            <label for="building">建物名</label>
            <input type="text" id="building" name="building">

            <button type="submit" class="update-button">更新する</button>
        </form>
    </div>
    @endsection
