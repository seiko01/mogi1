@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-container">
    @foreach ($products as $product)
    <div class="card">
        <img src="{{ $product->image }}" alt="商品画像">
        <div class="card-content">
            <div class="card-title">{{ $product->name }}</div>
            <div class="card-description">{{ $product->description }}</div>
            <a href="#" class="card-button">詳細を見る</a>
        </div>
    </div>
    @endforeach
</div>
@endsection
