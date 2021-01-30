<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MenuCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MenuCategory::create([
            'position' => '1',
            'menu_id' => '1',
            'category_id' => '1'
        ]);
        App\MenuCategory::create([
            'position' => '2',
            'menu_id' => '1',
            'category_id' => '2'
        ]);
        App\MenuCategory::create([
            'position' => '3',
            'menu_id' => '1',
            'category_id' => '4'
        ]);
    }
}
