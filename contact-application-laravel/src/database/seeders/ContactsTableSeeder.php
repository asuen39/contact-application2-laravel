<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // category_idの初期値
        $categoryId = 1;

        // データの挿入
        for ($i = 0; $i < 10; $i++) {
            DB::table('contacts')->insert([
                'category_id' => $categoryId,
                'first_name' => '山田',
                'last_name' => '太郎',
                'gender' => 1,
                'email' => 'test@example.com',
                'tell' => '123-456-7890',
                'address' => '東京都大田区蒲田1-2-3',
                'building' => '蒲田マンション101',
                'detail' => '届いた商品が注文した内容ではありませんでした。商品の交換をお願いします。',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // category_idを増やす
            $categoryId++;
        };
    }
}
