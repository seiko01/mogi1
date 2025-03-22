@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address_edit.css') }}">
@endsection

@section('content')
<div class="address-edit-container">
    <h2>送付先住所の変更</h2>
    
    <form action="{{ route('purchase.address.update', ['item_id' => $item->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="postcode">郵便番号:</label>
        <input type="text" id="postcode" name="postcode" value="{{ old('postcode', $profile->postcode) }}" required>

        <label for="address">住所:</label>
        <input type="text" id="address" name="address" value="{{ old('address', $profile->address) }}" required>

        <label for="building">建物名:</label>
        <input type="text" id="building" name="building" value="{{ old('building', $profile->building) }}">

        <button type="submit">更新する</button>
    </form>
</div>
@endsection