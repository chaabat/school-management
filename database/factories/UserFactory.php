<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'picture' => null,  
            'adress' => $this->faker->address(),
            'ville' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'genre' => $this->faker->randomElement(['masculin', 'feminin']),
            // 'classe_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8]),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('12345678'), 
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
