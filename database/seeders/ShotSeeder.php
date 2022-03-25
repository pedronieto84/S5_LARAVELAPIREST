<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shot;

class ShotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shot::factory(10)->create();
    }
}
