<?php

namespace Database\Factories;

use App\Models\AlarmType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlarmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'criticality'     => $this->faker->numberBetween(1, 5),
            'status'          => $this->faker->numberBetween(1, 3),
            'active'          => $this->faker->boolean(80),
            'date_occurred'   => $this->faker->dateTimeBetween('-1 month', 'now'),
            'alarms_types_id' => AlarmType::factory(),
        ];
    }
}
