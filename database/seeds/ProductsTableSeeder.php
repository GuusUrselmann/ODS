<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'name' => 'Dumplings',
            'description' => '3 Stuks, Groente vulling',
            'price' => 3.49,
            'image_path' => 'images/products/product_1.jpg'
        ]);

        App\Product::create([
            'name' => 'Gekookte eieren op toast',
            'description' => '',
            'price' => 2.20,
            'image_path' => 'images/products/product_2.jpg'
        ]);

        App\Product::create([
            'name' => 'Wentelteefjes met fruit',
            'description' => 'heerlijk wentelteefje met vers fruit',
            'price' => 3.80,
            'image_path' => 'images/products/product_3.jpg'
        ]);

        App\Product::create([
            'name' => 'Pizza margaritha',
            'description' => 'Steenoven gebakken in onze eigen keuken',
            'price' => 11.99,
            'image_path' => 'images/products/product_4.jpg'
        ]);

        App\Product::create([
            'name' => 'Broodje ongezond',
            'description' => 'sla, tomaten en vlees op een krokant broodje',
            'price' => 6.99,
            'image_path' => 'images/products/product_5.jpg'
        ]);

        App\Product::create([
            'name' => 'Croissant speciaal',
            'description' => 'Croissant met diverse toppings',
            'price' => 7.49,
            'image_path' => 'images/products/product_6.jpg'
        ]);
    }
}
