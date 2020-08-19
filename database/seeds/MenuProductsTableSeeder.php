<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MenuProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\MenuProduct::create([
            'position' => '1',
            'product_id' => '1',
            'menu_id' => '1',
            'menu_category_id' => '1'
        ]);
        App\MenuProduct::create([
            'position' => '2',
            'product_id' => '2',
            'menu_id' => '1',
            'menu_category_id' => '1'
        ]);
        App\MenuProduct::create([
            'position' => '1',
            'product_id' => '3',
            'menu_id' => '1',
            'menu_category_id' => '2'
        ]);
        App\MenuProduct::create([
            'position' => '2',
            'product_id' => '4',
            'menu_id' => '1',
            'menu_category_id' => '2'
        ]);
        App\MenuProduct::create([
            'position' => '3',
            'product_id' => '4',
            'menu_id' => '1',
            'menu_category_id' => '2'
        ]);
        App\MenuProduct::create([
            'position' => '4',
            'product_id' => '4',
            'menu_id' => '1',
            'menu_category_id' => '2'
        ]);
        App\MenuProduct::create([
            'position' => '5',
            'product_id' => '4',
            'menu_id' => '1',
            'menu_category_id' => '2'
        ]);
    }
}
