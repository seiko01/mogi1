<!-- resources/views/index.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="logo">COACHTECH</div>
        <input type="text" placeholder="なにをお探しですか？">
        <div class="nav-links">
            <a href="#">ログアウト</a>
            <a href="#">マイページ</a>
            <button class="sell-button">出品</button>
        </div>
    </nav>

    <div class="container">
        <div class="tab-menu">
            <a href="#" class="tab active">マイリスト</a>
            <a href="#" class="tab">おすすめ</a>
        </div>

        <div class="product-list">
            @foreach ($items as $item)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像">
                    <p>{{ $item->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
