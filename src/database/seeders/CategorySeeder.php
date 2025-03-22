<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['category' => 'ファッション'],
            ['category' => '電機'],
            ['category' => 'インテリア'],
            ['category' => 'レディース'],
            ['category' => 'メンズ'],
            ['category' => 'コスメ'],
            ['category' => '本'],
            ['category' => 'ゲーム'],
            ['category' => 'スポーツ'],
            ['category' => 'キッチン'],
            ['category' => 'ハンドメイド'],
            ['category' => 'アクセサリー'],
            ['category' => 'おもちゃ'],
            ['category' => 'ベビー・キッズ'],
        ];

        Category::insert($categories);
    }
}
