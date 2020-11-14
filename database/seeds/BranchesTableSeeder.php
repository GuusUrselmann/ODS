<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Branch::create([
            'contact_information_id' => 1,
            'name' => 'Restaurant Eindhoven',
            'email' => 'info@restaurant.nl',
            'cash' => true,
            'card' => true,
            'ideal' => true,
            'invoice' => true,
            'takeaway' => true,
            'delivery' => true,
            'delivery_costs' => 2.99,
            'delivery_free_at' => 25,
            'delivery_min_amount' => 10,
            'delivery_max_distance' => 99,
        ]);
    }
}
