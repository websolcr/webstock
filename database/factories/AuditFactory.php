<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuditFactory extends Factory
{
    public function definition(): array
    {
        return [
            'area' => $this->faker->word(),
            'member' => $this->faker->userName(),
            'action' => $this->faker->word(),
            'after_value' => $this->faker->words(3, true),
            'before_value' => $this->faker->words(3, true),
        ];
    }
}
