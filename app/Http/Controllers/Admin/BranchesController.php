<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function __construct()
    {
    }

    public function overview()
    {
        // TODO: hook up to database
        $branches = [
            [
                'id' => 1,
                'name' => 'Snackbar de Groot',
                'zipcode' => '2301 CD',
                'address' => 'Straatwegenlijk',
                'house_number' => '52',
                'city' => 'Amsterdam',
                'phonenumber' => '0612345678',
                'email' => 'snackbardegroot@gmail.com',
                'status' => 'active',
                'cash' => 1,
                'card' => 1,
                'ideal' => 1,
                'invoice' => 0,
                'takeaway' => 1,
                'delivery' => 1,
                'delivery_costs' => 4.50,
                'delivery_free_at' => 25.00,
                'delivery_min_amount' => 15.00,
                'delivery_max_distance_km' => 50,
                'created_at' => '30/06/2020',
                'updated_at' => null,
                'deleted_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Snackbar De Fantastico',
                'zipcode' => '2301 CD',
                'address' => 'Het Hof',
                'house_number' => '13',
                'city' => 'Den Haag',
                'phonenumber' => '0612345678',
                'email' => 'snackbardefantastico@gmail.com',
                'status' => 'active',
                'cash' => 0,
                'card' => 1,
                'ideal' => 1,
                'invoice' => 1,
                'takeaway' => 1,
                'delivery' => 1,
                'delivery_costs' => 5,
                'delivery_free_at' => 30.00,
                'delivery_min_amount' => 15.00,
                'delivery_max_distance_km' => 65,
                'created_at' => '29/06/2020',
                'updated_at' => null,
                'deleted_at' => null
            ],
        ];

        return view('admin.branches.overview', ['branches' => $branches]);
    }

    public function openingHours()
    {
        return view('admin.branches.openinghours');
    }

    public function add()
    {
        return view('admin.branches.add');
    }

    public function edit()
    {
        $branche =  [
            'id' => 2,
            'name' => 'Snackbar De Fantastico',
            'zipcode' => '2301 CD',
            'address' => 'Het Hof',
            'house_number' => '13',
            'city' => 'Den Haag',
            'phonenumber' => '0612345678',
            'email' => 'snackbardefantastico@gmail.com',
            'status' => 'inactive',
            'cash' => 0,
            'card' => 0,
            'ideal' => 0,
            'invoice' => 0,
            'takeaway' => 0,
            'delivery' => 0,
            'delivery_costs' => 5,
            'delivery_free_at' => 30.00,
            'delivery_min_amount' => 15.00,
            'delivery_max_distance_km' => 65,
            'created_at' => '29/06/2020',
            'updated_at' => null,
            'deleted_at' => null
        ];

        return view('admin.branches.edit', ['branche' => $branche]);
    }

    public function delete()
    {
    }

    public function save()
    {
        return redirect('/admin/filialen');
    }

    public function update()
    {
        return redirect('/admin/filialen');
    }
}
