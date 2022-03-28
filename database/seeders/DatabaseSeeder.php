<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Shot;
use App\Models\Player;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => 'admin', // password
            'remember_token' => Str::random(10), 
        ])->assignRole('Admin');

        User::factory(10)->create()->each(function($user){
            $user->assignRole('Player');
        });
        Player::factory(10)->create();
        Shot::factory(10)->create();


        

    }
}
