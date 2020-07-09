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
            'name' => 'Producten Overzicht',
            'slug' => 'producten_overzicht'
        ]);
        App\Permission::create([
            'name' => 'Producten Toevoegen',
            'slug' => 'producten_toevoegen'
        ]);
        App\Permission::create([
            'name' => 'Producten Verwijderen',
            'slug' => 'producten_verwijderen'
        ]);
        App\Permission::create([
            'name' => 'Gebruikers Overzicht',
            'slug' => 'gebruikers_overzicht'
        ]);
        App\Permission::create([
            'name' => 'Gebruikers Toevoegen',
            'slug' => 'gebruikers_toevoegen'
        ]);
        App\Permission::create([
            'name' => 'Gebruikers Verwijderen',
            'slug' => 'gebruikers_verwijderen'
        ]);
    }
}
