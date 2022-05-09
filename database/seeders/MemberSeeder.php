<?php

namespace Database\Seeders;

use App\Models\Domain\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        Member::create([
            'global_id' => auth()->id(),
        ]);
    }
}