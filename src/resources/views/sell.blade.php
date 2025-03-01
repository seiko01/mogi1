@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-container">
    <h2 class="title">商品の出品</h2>

    <div class="image-upload">
        <label for="product-image" class="image-label">画像を選択する</label>
        <input type="file" id="product-image" class="image-input">
    </div>

    <div class="product-details">
        <h3>商品の詳細</h3>
        <div class="categories">
            @foreach(['ファッション', '電気', 'インテリア', 'レディース', 'メンズ', 'コスメ', '木', 'ゲーム', 'スポーツ', 'キッチン', 'ハンドメイド', 'アクセサリー', 'おもちゃ', 'ベビー・キッズ'] as $category)
                <span class="category-item">{{ $category }}</span>
            @endforeach
        </div>

        <label for="product-condition">商品の状態</label>
        <select id="product-condition">
            <option value="">選択してください</option>
            <option value="new">新品・未使用</option>
            <option value="used">中古</option>
        </select>
    </div>

    <div class="product-info">
        <h3>商品名と説明</h3>
        <input type="text" placeholder="商品名">
        <input type="text" placeholder="ブランド名">
        <textarea placeholder="商品の説明"></textarea>
        <input type="text" placeholder="¥ 販売価格">
    </div>

    <button class="submit-button">出品する</button>
</div>
@endsection
