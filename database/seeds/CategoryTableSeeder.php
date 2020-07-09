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
            'name' => 'Broodjes',
            'slug' => 'broodjes'
        ]);

        App\Category::create([
            'name' => 'Pizza\'s',
            'slug' => 'pizzas'
        ]);

        App\Category::create([
            'name' => 'Drankjes',
            'slug' => 'drankjes'
        ]);
    }
}
