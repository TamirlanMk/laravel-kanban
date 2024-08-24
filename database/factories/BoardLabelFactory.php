<?php

namespace Database\Factories;

use App\Models\BoardLabel;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardLabelFactory extends Factory
{
    protected $model = BoardLabel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'color' => $this->faker->hexColor()
        ];
    }
}
