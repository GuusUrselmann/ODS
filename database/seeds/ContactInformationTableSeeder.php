<?php

use Illuminate\Database\Seeder;

class ContactInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ContactInformation::create([
            'street_name' => 'teststraat',
            'house_number' => '43',
            'zipcode' => '1633CH',
            'city' => 'Eindhoven',
            'phone' => '0629401552',
        ]);
    }
}
