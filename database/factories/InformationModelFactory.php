<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InformationModel>
 */
class InformationModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'age' => fake()->numberBetween(18, 90),
            'smoking' => fake()->boolean(),
            'province' => fake()->state(),
            'city' => fake()->city(),
            'neighborhood' => fake()->streetAddress(),
            'from_money' => fake()->numberBetween(100000, 1000000),
            'up_money' => fake()->numberBetween(1000000, 5000000),
            'about_user' => fake()->text(200),
            'image' => fake()->imageUrl(),
        
        ];
    }
}
