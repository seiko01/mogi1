@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<body>
    <div class="container">
        <div class="tab-menu">
            <a href="#" class="tab active">マイリスト</a>
            <a href="#" class="tab">おすすめ</a>
        </div>
        <div class="product-list">
            @foreach ($items as $item)
                <div class="product-card">
                    <a href="{{ route('item.show', ['item' => $item->id]) }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                        <p>{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
@endsection
