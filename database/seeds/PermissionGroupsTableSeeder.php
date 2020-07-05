<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PermissionGroup::create([
            'permission_id' => '1',
            'group_id' => '1'
        ]);
        App\PermissionGroup::create([
            'permission_id' => '2',
            'group_id' => '1'
        ]);
        App\PermissionGroup::create([
            'permission_id' => '3',
            'group_id' => '1'
        ]);
    }
}
