@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-container">
    <div class="product-info">
        <div class="product-image">
            <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
        </div>
        <div class="product-details">
            <h2 class="product-name">{{ $item->name }}</h2>
            <p class="product-price">¥ {{ number_format($item->price) }}</p>
        </div>
    </div>
@if ($item->status != 'sold_out')
<form action="{{ route('purchase.process', ['item' => $item->id]) }}" method="POST">
    @csrf
    <div class="purchase-wrapper">
        <div class="purchase-details">
            <div class="payment-section">
            <h3>支払い方法</h3>
                <select name="payment_method" class="payment-method" required>
                    <option value="">選択してください</option>
                    <option value="credit" {{ old('payment_method') === 'credit' ? 'selected' : '' }}>クレジットカード</option>
                    <option value="convenience" {{ old('payment_method') === 'convenience' ? 'selected' : '' }}>コンビニ払い</option>
                    <option value="bank" {{ old('payment_method') === 'bank' ? 'selected' : '' }}>銀行振込</option>
                </select>
            </div>
            <div class="shipping-section">
                <h3>配送先</h3>
                <p>〒 {{ optional(Auth::user()->profile)->postcode ?? '未登録' }}</p>
                <p>
                    {{ optional(Auth::user()->profile)->address ?? '未登録' }}
                    {{ optional(Auth::user()->profile)->building ?? '' }}
                </p>
                <a href="{{ route('purchase.address.edit', ['item_id' => $item->id]) }}" class="change-address">変更する</a>
            </div>
        </div>

        <div class="order-summary">
            <table>
                <tr>
                    <td>商品代金</td>
                    <td>¥ {{ number_format($item->price) }}</td>
                </tr>
                <tr>
                    <td>支払い方法</td>
                    <td>
                        @if (old('payment_method') === 'credit')
                            クレジットカード
                        @elseif (old('payment_method') === 'convenience')
                            コンビニ払い
                        @elseif (old('payment_method') === 'bank')
                            銀行振込
                        @else
                            選択されていません
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <button type="submit" class="purchase-button">購入する</button>
</form>
@else
        <button type="button" class="purchase-button" disabled>購入済み</button>
    @endif
</div>
@endsection