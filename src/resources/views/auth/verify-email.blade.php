@extends('layouts.app')

@section('content')
<div class="container">
    <h2>メール認証が必要です</h2>
    <p>登録していただいたメールアドレスに認証メールを送付しました。メール認証を完了してください。</p>
    
    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit">認証メールを再送信</button>
    </form>
</div>
@endsection