<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UserType::create([
            'name' => 'Eigenaar',
            'slug' => 'eigenaar',
            'group_id' => '1'
        ]);
    }
}
