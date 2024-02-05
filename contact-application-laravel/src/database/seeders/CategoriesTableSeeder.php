<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // カテゴリを挿入するデータを定義
        $categories = [
            ['content' => 'カテゴリ1'],
            ['content' => 'カテゴリ2'],
            ['content' => 'カテゴリ3'],
        ];

        // テーブルにデータを挿入
        DB::table('categories')->insert($categories);
    }
}
