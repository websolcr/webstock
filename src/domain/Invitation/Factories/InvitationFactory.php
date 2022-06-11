<?php

namespace Domain\Invitation\Factories;

use function tenant;
use Illuminate\Support\Str;
use Domain\Invitation\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
{
    protected $model = Invitation::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->safeEmail(),
            'tenant_id' => tenant('id'),
            'token' => Str::random(32),
        ];
    }
}
