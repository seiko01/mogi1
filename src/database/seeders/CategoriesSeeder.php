<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['category' => 'ファッション'],
            ['category' => '家電'],
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

        // 既存のデータを削除
        DB::table('categories')->delete();

        // AUTO_INCREMENT をリセット（MySQL専用）
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1;');

        // データを挿入
        foreach ($categories as $index => $category) {
            DB::table('categories')->insert([
                'id' => $index + 1,
                'category' => $category['category'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
