@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">
    <div class="mypage-header">
        <img src="プロフィール画像" alt="ユーザー画像" class="mypage-image">
        <div class="mypage-username">ユーザー名</div>
        <a href="{{ route('profile.edit') }}" class="mypage-edit-button">プロフィールを編集</a>
    </div>

    <div class="mypage-tabs">
        <a href="#" class="mypage-tab active">出品した商品</a>
        <a href="#" class="mypage-tab">購入した商品</a>
    </div>

    <div class="mypage-items">
        @for ($i = 0; $i < 6; $i++)
        <div class="mypage-item">
            <div class="mypage-item-image">商品画像</div>
            <div class="mypage-item-name">商品名</div>
        </div>
        @endfor
    </div>
</div>
@endsection
