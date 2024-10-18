<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->default()->count(1)->create();
        /*User::factory()->count(90)->create();

        User::factory()
            ->withAvatar()
            ->count(10)
            ->create();*/


        foreach(User::all() as $user){
            $user->generateCodes();
        }
    }
}
