<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Couponcode;

class CouponcodesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function overview() {
        $couponcodes = Couponcode::all();
        return view('admin.couponcodes.couponcodes', compact('couponcodes'));
    }

    public function add() {
        return view('admin.couponcodes.add');
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:25',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/couponcodes/toevoegen'))->with('errors', $errors);
        }
        $couponcode = Couponcode::create([
            'code' => $request->input('code'),
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
            'sort' => $request->input('sort'),
            'min_amount_spent' => $request->input('min_amount_spent'),
        ]);
        return redirect(url('/admin/couponcodes'));
    }

    public function edit($id) {
        $couponcode = Couponcode::find($id);
        return view('admin.couponcodes.edit', compact('couponcode'));
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:25',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/couponcodes/bewerken/'.$id))->with('errors', $errors);
        }
        $couponcode = Couponcode::find($id);
        $couponcode->update([
            'code' => $request->input('code'),
            'amount' => str_replace(',', '.', $request->input('amount')),
            'type' => $request->input('type'),
            'sort' => $request->input('sort'),
            'min_amount_spent' => str_replace(',', '.', $request->input('min_amount_spent')),
        ]);
        return redirect(url('/admin/couponcodes'));
    }
}
