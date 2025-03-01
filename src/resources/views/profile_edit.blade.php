@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
@endsection

@section('content')
<div class="profile-edit__container">
    <div class="profile-edit__title">
        <h2>プロフィール設定</h2>
    </div>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-edit__image">
            <img src="{{ asset('img/default-profile.png') }}" alt="プロフィール画像">
            <label class="profile-edit__image-btn">画像を選択する <input type="file" name="profile_image" hidden></label>
        </div>
        <div class="profile-edit__form">
            <label for="username">ユーザー名</label>
            <input type="text" name="username" value="{{ old('username') }}">
            <label for="postcode">郵便番号</label>
            <input type="text" name="postcode" value="{{ old('postcode') }}">
            <label for="address">住所</label>
            <input type="text" name="address" value="{{ old('address') }}">
            <label for="building">建物名</label>
            <input type="text" name="building" value="{{ old('building') }}">
        </div>
        <div class="profile-edit__button">
            <button type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection