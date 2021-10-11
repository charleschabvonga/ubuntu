<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseTwoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Agent::factory(10)->create();
    }
}
