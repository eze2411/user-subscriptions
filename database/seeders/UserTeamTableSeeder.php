<?php

namespace Database\Seeders;

use App\Models\UserTeam;
use Illuminate\Database\Seeder;

class UserTeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTeam::factory()
            ->times(50)
            ->create();
    }
}
