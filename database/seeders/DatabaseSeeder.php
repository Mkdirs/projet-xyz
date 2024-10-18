<?php

namespace Database\Seeders;

use App\Models\InvitationCode;
use App\Models\Track;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create weeks
        $this->call(WeekSeeder::class);

        // Create users
        User::factory(1)
            ->admin()
            ->has(InvitationCode::factory()->count(5), 'codes')
            ->has(Track::factory()->count(1))
            ->create();



        User::factory(10)
            ->has(InvitationCode::factory()->count(5), 'codes')
            ->create();
    }
}
