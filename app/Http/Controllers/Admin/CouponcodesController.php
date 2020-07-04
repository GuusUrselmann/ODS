<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Couponcode;
use App\Branch;

class CouponcodesController extends Controller
{
    public function __construct()
    {
    }

    public function overview()
    {
        $couponcodes = Couponcode::all();
        
        // $couponcodes = [
        //     [
        //         'code' => 'S3F02',
        //         'amount' => '10.00',
        //         'status' => 'active',
        //         'active_till' => '10-07-20',
        //         'type' => 'delivery',
        //         'sort' => 'percentage',
        //         'min_amount_spent' => '30.00',
        //         'one_off' => 'true',
        //         'created_at' => '30-06-20'
        //     ],
        //     [
        //         'code' => 'S3F03',
        //         'amount' => '15.00',
        //         'sort' => 'percentage',
        //         'status' => 'active',
        //         'active_till' => '20-07-20',
        //         'type' => 'takeaway',
        //         'min_amount_spent' => '50.00',
        //         'one_off' => 'true',
        //         'created_at' => '30-06-20'
        //     ],
        //     [
        //         'code' => 'S3F04',
        //         'amount' => '5.00',
        //         'sort' => 'amount',
        //         'status' => 'active',
        //         'active_till' => '12-07-20',
        //         'type' => 'both',
        //         'min_amount_spent' => '20.00',
        //         'one_off' => 'true',
        //         'created_at' => '30-06-20'
        //     ]
        // ];

        return view('admin.couponcodes.overview', [
            'couponcodes' => $couponcodes,
        ]);
    }

    public function add()
    {
        // $branches = Branch::all();
        $branches = [
            [
                'id' => 1,
                'name' => 'Snackbar De Groot'
            ],
            [
                'id' => 2,
                'name' => 'Snackbar Dollenhuis'
            ],
        ];

        return view('admin.couponcodes.add', [
            'branches' => $branches
        ]);
    }

    public function edit()
    {
        // $branches = Branch::all();
        $couponcode = Couponcode::find(request('id'));
        $branches = [
            [
                'id' => 1,
                'name' => 'Snackbar De Groot'
            ],
            [
                'id' => 2,
                'name' => 'Snackbar Dollenhuis'
            ],
        ];

        return view('admin.couponcodes.edit', [
            'couponcode' => $couponcode,
            'branches' => $branches
        ]);
    }

    /*
    *   Method to insert new categories into the datbase
    */
    public function save()
    {
        $couponcode = new Couponcode();

        $couponcode->branch_id = request('branch_id');
        $couponcode->code = request('code');
        $couponcode->amount = request('amount');
        $couponcode->status = request('status');
        $couponcode->active_from = request('active_from');
        $couponcode->active_till = request('active_till');
        $couponcode->type = request('type');
        $couponcode->sort = request('sort');
        $couponcode->min_amount_spent = request('min_amount_spent');
        $couponcode->one_off = request('one_off');

        $couponcode->save();

        return redirect('/admin/couponcodes');
    }

    /*
    *   Method to update existing categories into the datbase
    */
    public function update()
    {
        $couponcode = Couponcode::find(request('id'));

        $couponcode->branch_id = request('branch_id');
        $couponcode->code = request('code');
        $couponcode->amount = request('amount');
        $couponcode->status = request('status');
        $couponcode->active_from = request('active_from');
        $couponcode->active_till = request('active_till');
        $couponcode->type = request('type');
        $couponcode->sort = request('sort');
        $couponcode->min_amount_spent = request('min_amount_spent');
        $couponcode->one_off = request('one_off');

        $couponcode->save();

        return redirect('/admin/couponcodes');
    }

    public function delete() {
        
    }
}
