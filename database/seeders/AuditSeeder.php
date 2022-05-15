<?php

namespace Database\Seeders;

use App\Models\Audit;
use Illuminate\Database\Seeder;

class AuditSeeder extends Seeder
{
    public function run()
    {
        Audit::factory(10)->create();
    }
}
