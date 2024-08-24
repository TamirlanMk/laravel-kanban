<?php

namespace Database\Factories;

use App\Models\BoardColumn;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardColumnFactory extends Factory
{
    protected $model = BoardColumn::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'position' => 0
        ];
    }
}
