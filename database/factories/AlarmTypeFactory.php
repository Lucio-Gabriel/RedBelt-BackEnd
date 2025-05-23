<?php

namespace Database\Factories;

use App\Models\AlarmType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlarmTypeFactory extends Factory
{
    protected $model = AlarmType::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->word(),
            'description' => $this->faker->sentence,
        ];
    }
}
