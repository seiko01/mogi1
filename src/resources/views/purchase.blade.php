@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-container">
    <div class="product-info">
        <div class="product-image">
            <span>商品画像</span>
        </div>
        <div class="product-details">
            <h2 class="product-name">商品名</h2>
            <p class="product-price">¥ 47,000</p>
        </div>
    </div>

    <div class="payment-section">
        <h3>支払い方法</h3>
        <select class="payment-method">
            <option value="">選択してください</option>
            <option value="credit">クレジットカード</option>
            <option value="convenience">コンビニ払い</option>
            <option value="bank">銀行振込</option>
        </select>
    </div>

    <div class="shipping-section">
        <h3>配送先</h3>
        <p>〒 XXX-YYYY</p>
        <p>ここには住所と建物が入ります</p>
        <a href="#" class="change-address">変更する</a>
    </div>

    <div class="order-summary">
        <table>
            <tr>
                <td>商品代金</td>
                <td>¥ 47,000</td>
            </tr>
            <tr>
                <td>支払い方法</td>
                <td>コンビニ払い</td>
            </tr>
        </table>
        <button class="purchase-button">購入する</button
