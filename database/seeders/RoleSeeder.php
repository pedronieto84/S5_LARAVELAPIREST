<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleA = Role::create(['name' => 'Admin']);
        $roleP = Role::create(['name' => 'Player']);

        Permission::create(['name'=> 'players.store'])->syncRoles($roleA,$roleP);
        Permission::create(['name'=> 'players.update'])->syncRoles($roleA,$roleP);
        Permission::create(['name'=> 'shots.store'])->syncRoles($roleA,$roleP);
        Permission::create(['name'=> 'shots.destroy'])->syncRoles($roleA,$roleP);
        Permission::create(['name'=> 'playershots.show'])->syncRoles($roleA,$roleP);

        Permission::create(['name'=> 'players.index'])->assignRole($roleA);
        Permission::create(['name'=> 'players.rank'])->assignRole($roleA);
        Permission::create(['name'=> 'players.rankloser'])->assignRole($roleA);
        Permission::create(['name'=> 'players.rankwinner'])->assignRole($roleA);

        
    }
}
