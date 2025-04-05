@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-container">
    <h1>商品の出品</h1>
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="image-upload">
            <label>商品画像</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="details-section">
            <h2>商品の詳細</h2>

            <label>カテゴリー</label>
            <div class="categories">
                @foreach($categories as $category)
                    <label class="category-btn">
                        <input type="radio" name="category_id" value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id ? 'checked' : '' }}>
                        <span>{{ $category->category }}</span>
                    </label>
                @endforeach
            </div>
            <label>商品の状態</label>
            <select name="condition_id">
                <option value="">選択してください</option>
                @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" 
                        {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                        {{ $condition->name }}
                    </option>
                @endforeach
            </select>
            <h2>商品名と説明</h2>
            <label>商品名</label>
            <input type="text" name="name">

            <label>ブランド名</label>
            <input type="text" name="brand_name">

            <label>商品の説明</label>
            <textarea name="description"></textarea>

            <label>販売価格</label>
            <input type="number" name="price" placeholder="¥">
        </div>

        <button type="submit" class="submit-btn">出品する</button>
    </form>
</div>
@endsection