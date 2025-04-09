@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<div class="mypage-container">
    <div class="profile-section">
        <div class="profile-image">
            <img src="{{ $user->profile && $user->profile->image ? asset('storage/' . $user->profile->image) : asset('images/default-avatar.png') }}" alt="プロフィール画像">
        </div>
        <div class="profile-info">
            <h2>{{ $user->name }}</h2>
            <a href="{{ route('profile.edit') }}" class="edit-button">プロフィールを編集</a>
        </div>
    </div>

    <div class="tab-menu">
        <a href="?tab=selling" class="{{ request('tab') !== 'bought' ? 'active' : '' }}">出品した商品</a>
        <a href="?tab=bought" class="{{ request('tab') === 'bought' ? 'active' : '' }}">購入した商品</a>
    </div>

    <div class="item-grid">
        @forelse ($items as $item)
            <div class="item-card">
                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/no-image.png') }}" alt="商品画像">
                <p>{{ $item->name }}</p>
            </div>
        @empty
            <p>商品が見つかりませんでした。</p>
        @endforelse
    </div>
</div>
@endsection
