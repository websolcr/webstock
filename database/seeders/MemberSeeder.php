<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create();

        Member::create([
            'global_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'admin',
        ]);
    }
}
