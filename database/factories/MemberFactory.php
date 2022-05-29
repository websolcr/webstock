<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'global_id' => Str::uuid()->toString(),
            'name'=>$this->faker->name(),
            'email'=>$this->faker->unique()->safeEmail(),
            'role'=> 'admin',
        ];
    }
}
