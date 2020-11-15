<?php

namespace Database\Seeders;

use App\Models\Billing;
use Illuminate\Database\Seeder;

class BillingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Billing::factory()
            ->times(50)
            ->create();
    }
}
