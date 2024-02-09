<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contacts;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriesTableSeeder::class,
            ContactsTableSeeder::class,
        ]);

        Contacts::factory()->count(35)->create();
    }
}
