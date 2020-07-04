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
        
        // TODO: build one query
        foreach($couponcodes as $couponcode) {
            $branch = Branch::find($couponcode['branch_id']);
            $couponcode['branch_name'] = $branch['name'];
        }
        
        return view('admin.couponcodes.overview', [
            'couponcodes' => $couponcodes,
        ]);
    }

    public function add()
    {
        $branches = Branch::all();

        return view('admin.couponcodes.add', [
            'branches' => $branches
        ]);
    }

    public function edit()
    {
        $couponcode = Couponcode::find(request('id'));
        $branches = Branch::all();

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
