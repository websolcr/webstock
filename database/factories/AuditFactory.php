<?php

namespace Database\Factories;

use Support\Audit\AuditArea;
use Domain\Audit\Models\Audit;
use Support\Audit\AuditAction;
use Domain\Member\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditFactory extends Factory
{
    protected $model = Audit::class;

    public function definition(): array
    {
        return [
            'area' => $this->faker->randomElement(AuditArea::cases()),
            'member_id' => Member::factory()->create(),
            'action' => $this->faker->randomElement(AuditAction::cases()),
            'after_value' => $this->faker->words(3, true),
            'before_value' => $this->faker->words(3, true),
        ];
    }
}
