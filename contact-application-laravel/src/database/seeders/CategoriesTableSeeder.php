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
            ['content' => '商品の交換について'],
            ['content' => '返品について'],
            ['content' => '破損商品について'],
        ];

        // テーブルにデータを挿入
        DB::table('categories')->insert($categories);
    }
}
