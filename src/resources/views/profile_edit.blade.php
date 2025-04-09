@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
@endsection

@section('content')
<body>
    <div class="mypage-container">
        <h1>プロフィール設定</h1>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="image-upload">
                <label for="image-upload" class="profile-image">
                    <img src="{{ $user->profile && $user->profile->image ? asset('storage/' . $user->profile->image) : asset('images/default-avatar.png') }}" alt="プロフィール画像">
                    <input type="file" name="image" id="image-upload">
                </label>
            </div>
            <label>ユーザー名</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
            <label>郵便番号</label>
                <input type="text" name="postcode" value="{{ old('postcode', Auth::user()->profile->postcode ?? '') }}">
            <label>住所</label>
                <input type="text" name="address" value="{{ old('address', Auth::user()->profile->address ?? '') }}">
            <label>建物名</label>
                <input type="text" name="building" value="{{ old('building', Auth::user()->profile->building ?? '') }}">
            <button type="submit" class="submit-btn">更新する</button>
        </form>
    </div>
</body>
@endsection