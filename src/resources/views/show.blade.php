@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <div class="product-detail-container">
        <div class="product-img-area">
            <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
        </div>
        <div class="product-descriotion-area">
            <h2>{{ $item->name }}</h2>
            <p>ブランド: {{ $item->brand_name }}</p>
            <p>¥{{ number_format($item->price) }}（税込）</p>
            <div class="icon-wrapper">
            {{-- ⭐ いいね --}}
            @php
                $likeCount = $item->likes ? $item->likes->count() : 0;
            @endphp

            @if(isset($isLiked) && $isLiked)
                <form action="{{ route('like.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-button" title="いいねを取り消す">
                        ⭐
                        <div class="icon-count">{{ $likeCount }}</div>
                    </button>
                </form>
            @else
                <form action="{{ route('like.store', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="icon-button" title="いいねする">
                        ⭐
                        <div class="icon-count">{{ $likeCount }}</div>
                    </button>
                </form>
            @endif
                {{-- 💬 コメント数 --}}
                <div class="icon-button" title="コメント数">
                    💬
                    <div class="icon-count">{{ isset($item->comments) ? $item->comments->count() : 0 }}</div>
                </div>
            </div>
            <form action="{{ route('purchase.show', ['item' => $item->id]) }}" method="GET">
            @csrf
                <button type="submit" class="btn btn-primary">購入手続きへ</button>
            </form>
            <h3>商品説明</h3>
            <p>{{ $item->description }}</p>
            <h3>商品の情報</h3>
            <p>カテゴリー:{{ $item->category->category }}</p>
            <p>商品の状態:{{ $item->condition->name }}</p>
            <h3>コメント ({{ $item->comments->count() }})</h3>
                @if ($item->comments->isEmpty())
                    <p>コメントはありません。</p>
                @else
                @foreach ($item->comments as $comment)
                    <div class="comment">
                        <div class="comment-user">
                            {{-- アイコンを表示 --}}
                            @if ($comment->user->icon)
                                <img src="{{ asset('storage/' . $comment->user->icon) }}" alt="User Icon" class="user-icon">
                            @else
                                <div class="user-icon">👤</div>
                            @endif
                            {{-- 名前を表示 --}}
                            <span class="username">{{ $comment->user->name }}</span>
                        </div>
                        {{-- コメント本文を表示 --}}
                        <p class="comment-text">{{ $comment->comment }}</p>
                    </div>
                @endforeach
            @endif

            <h3>商品へのコメント</h3>
            <div class='comments-input'>
                <form action="{{ route('comments.store', ['item' => $item->id]) }}" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントを入力してください" required></textarea>
                    <button type="submit" class="comment-button">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
@endsection