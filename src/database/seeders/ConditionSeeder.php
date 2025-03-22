<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    public function run()
    {
        $conditions = [
            ['name' => '良好'],
            ['name' => '目立った傷や汚れなし'],
            ['name' => 'やや傷や汚れあり'],
            ['name' => '状態が悪い'],
        ];

        // 既存のデータを削除
        DB::table('conditions')->delete();

        // AUTO_INCREMENT をリセット（MySQL専用）
        DB::statement('ALTER TABLE conditions AUTO_INCREMENT = 1;');

        // データを挿入
        foreach ($conditions as $index => $condition) {
            DB::table('conditions')->insert([
                'name' => $condition['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
