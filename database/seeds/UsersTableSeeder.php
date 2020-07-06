<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'email' => 'guusurselmann@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'first_name' => 'Guus',
            'last_name' => 'Urselmann',
            'user_type_id' => '1',
            'remember_token' => Str::random(10)
        ]);

        factory(App\User::class, 58)->create();
    }
}
