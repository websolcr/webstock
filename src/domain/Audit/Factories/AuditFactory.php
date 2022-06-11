<?php

namespace Domain\Audit\Factories;

use App\Data\AuditData;
use Domain\Audit\Models\Audit;
use Domain\Member\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditFactory extends Factory
{
    protected $model = Audit::class;

    public function definition(): array
    {
        return [
            'area' => $this->faker->randomElement(AuditData::FILTERS['areas']),
            'member_id' => Member::factory()->create(),
            'action' => $this->faker->randomElement(AuditData::FILTERS['actions']),
            'after_value' => $this->faker->words(3, true),
            'before_value' => $this->faker->words(3, true),
        ];
    }
}
