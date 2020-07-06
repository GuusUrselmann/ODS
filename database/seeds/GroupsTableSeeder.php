<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Group::create([
            'name' => 'Eigenaar',
            'slug' => 'eigenaar'
        ]);
        App\Group::create([
            'name' => 'Klant Permissies',
            'slug' => 'klant_permissies'
        ]);
    }
}
