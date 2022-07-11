<?php

namespace Database\Factories;

use Domain\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'primary_contact_no' => $this->faker->phoneNumber(),
            'secondary_contact_no' => $this->faker->randomElement([null, $this->faker->phoneNumber()]),
        ];
    }
}
