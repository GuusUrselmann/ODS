<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;

class BranchesController extends Controller
{
    public function __construct()
    {
    }

    public function overview()
    {
        $branches = Branch::all();

        return view('admin.branches.overview', ['branches' => $branches]);
    }

    public function openingHours()
    {
        // TODO: hoop up database
        $openinghours = [
            'delivery' => [
                'monday' => [
                    'open' => true,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ],
                'tuesday' => [
                    'open' => true,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ],
                'wednesday' => [
                    'open' => false,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ],
                'thursday' => [
                    'open' => true,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ],
                'friday' => [
                    'open' => false,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ],
                'saturday' => [
                    'open' => true,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ],
                'sunday' => [
                    'open' => true,
                    'openinghour' => '16:00',
                    'closinghour' => '22:00',
                ]
            ],
            'takeaway' => [
                'monday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ],
                'tuesday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ],
                'wednesday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ],
                'thursday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ],
                'friday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ],
                'saturday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ],
                'sunday' => [
                    'open' => true,
                    'openinghour' => '17:00',
                    'closinghour' => '22:30',
                ]
            ]
        ];

        return view('admin.branches.openinghours', [
            'delivery' => $openinghours['delivery'],
            'takeaway' => $openinghours['takeaway']
        ]);
    }

    public function add()
    {
        return view('admin.branches.add');
    }

    public function edit()
    {
        $branch = Branch::selectOne(request('id'));
        
        return view('admin.branches.edit', ['branch' => $branch]);
    }

    public function delete()
    {
    }

    public function save()
    {
        $branch = new Branch();

        $branch->name = request('name');
        $branch->address = request('address');
        $branch->house_number = request('house_number');
        $branch->city = request('city');
        $branch->zipcode = request('zipcode');
        $branch->phonenumber = request('phonenumber');
        $branch->email = request('email');
        $branch->status = request('status');
        $branch->cash = request('cash');
        $branch->card = request('card');
        $branch->ideal = request('ideal');
        $branch->invoice = request('invoice');
        $branch->takeaway = request('takeaway');
        $branch->delivery = request('delivery');
        $branch->delivery_costs = request('delivery_costs');
        $branch->delivery_free_at = request('delivery_free_at');
        $branch->delivery_min_amount = request('delivery_min_amount');
        $branch->delivery_max_distance = request('delivery_max_distance');
        // $branch->created_at = request('created_at');

        $branch->save();

        return redirect('/admin/filialen');
    }

    public function update()
    {
        $branch = Branch::find(request('id'));

        $branch->name = request('name');
        $branch->address = request('address');
        $branch->house_number = request('house_number');
        $branch->city = request('city');
        $branch->zipcode = request('zipcode');
        $branch->phonenumber = request('phonenumber');
        $branch->email = request('email');
        $branch->status = request('status');
        $branch->cash = request('cash');
        $branch->card = request('card');
        $branch->ideal = request('ideal');
        $branch->invoice = request('invoice');
        $branch->takeaway = request('takeaway');
        $branch->delivery = request('delivery');
        $branch->delivery_costs = request('delivery_costs');
        $branch->delivery_free_at = request('delivery_free_at');
        $branch->delivery_min_amount = request('delivery_min_amount');
        $branch->delivery_max_distance = request('delivery_max_distance');

        $branch->update();

        return redirect('/admin/filialen');
    }
}
