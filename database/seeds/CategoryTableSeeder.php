<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create([
            'name' => 'Hoofdgerecht',
            'slug' => 'hoofdgerecht'
        ]);

        App\Category::create([
            'name' => 'Voorgerecht',
            'slug' => 'voorgerecht'
        ]);

        App\Category::create([
            'name' => 'Nagerecht',
            'slug' => 'Nagerecht'
        ]);
    }
}
