@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<body>
    <div class="container">
        <div class="tab-menu">
            <a href="?tab=recommend" class="{{ request('tab') === 'recommend' ? 'active' : '' }}">おすすめ</a>
            <a href="?tab=mylist" class="{{ request('tab') !== 'recommend' ? 'active' : '' }}">マイリスト</a>
        </div>

        <div class="product-list">
            @foreach ($items as $item)
                <div class="product-card">
                    <a href="{{ route('item.show', ['item' => $item->id]) }}">
                        <img src="{{ $item->img_url }}" alt="商品画像">
                        <p>{{ $item->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</body>
@endsection
