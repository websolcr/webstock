<?php

namespace Domain\Member\Factories;

use Illuminate\Support\Str;
use Domain\Member\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;

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
