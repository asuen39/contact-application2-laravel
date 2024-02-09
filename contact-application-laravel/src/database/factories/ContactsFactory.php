<?php

namespace Database\Factories;

use App\Models\Contacts;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Contacts::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['1', '2', '3']),
            'email' => $this->faker->unique()->safeEmail,
            'tell' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->text,
            'category_id' => Category::all()->random()->id, // ランダムにカテゴリーIDを選択
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
