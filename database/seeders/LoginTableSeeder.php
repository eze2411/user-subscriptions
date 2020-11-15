<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Seeder;

class LoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Login::factory()
            ->times(50)
            ->create();
    }
}
