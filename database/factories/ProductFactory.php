<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'article' => $this->faker->unique()->regexify('[a-zA-Z0-9]{6,18}'),
            'name' => $this->faker->words(rand(5, 8), true),
            'status' => $this->faker->randomElement(Status::cases()),
            'data' => ['цвет' => $this->faker->word(), 'размер' => $this->faker->word(), 'вкус' => $this->faker->word()],
        ];
    }
}
