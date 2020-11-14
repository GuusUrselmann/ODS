<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Branch;

class BranchController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function branch() {
        $branch = Branch::with('contactInformation')->first();
        return view('admin.branch.branch', compact('branch'));
    }

    public function branchSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/filiaal'))->with('errors', $errors);
        }
        $branch = Branch::first();
        $contact_information = $branch->contactInformation->first();
        $branch->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'cash' => $request->input('cash') ? 1 : 0,
            'card' => $request->input('card') ? 1 : 0,
            'ideal' => $request->input('ideal') ? 1 : 0,
            'invoice' => $request->input('invoice') ? 1 : 0,
            'takeaway' => $request->input('takeaway') ? 1 : 0,
            'delivery' => $request->input('delivery') ? 1 : 0,
            'delivery_free_at' => $request->input('delivery_free_at'),
            'delivery_min_amount' => $request->input('delivery_min_amount'),
            'delivery_areas' => $request->input('delivery_areas'),
        ]);
        $contact_information->update([
            'street_name' => $request->input('contact_street_name'),
            'house_number' => $request->input('contact_house_number'),
            'zipcode' => $request->input('contact_zipcode'),
            'city' => $request->input('contact_city'),
            'phone' => $request->input('contact_phone'),
        ]);
        return redirect(url('/admin/filiaal'));
    }
}
