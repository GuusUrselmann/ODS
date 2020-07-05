<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Permission::create([
            'name' => 'Perm1',
            'slug' => 'perm1'
        ]);
        App\Permission::create([
            'name' => 'Perm2',
            'slug' => 'perm2'
        ]);
        App\Permission::create([
            'name' => 'Perm3',
            'slug' => 'perm3'
        ]);
    }
}
