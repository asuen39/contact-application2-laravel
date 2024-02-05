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
        // データの挿入
        DB::table('contacts')->insert([
            'category_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 1,
            'email' => 'john@example.com',
            'tell' => '123-456-7890',
            'address' => '123 Main Street',
            'building' => 'Apt 101',
            'detail' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 他のデータの挿入
        DB::table('contacts')->insert([
            // 他のデータをここに追加
        ]);
    }
}
