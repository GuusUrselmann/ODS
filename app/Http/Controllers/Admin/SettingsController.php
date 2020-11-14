<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Option;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct() {
         $this->middleware('auth');
     }

    public function website() {
        $website_title = Option::where('name', 'website_title')->first();
        $header_title = Option::where('name', 'header_title')->first();
        return view('admin.settings.website', compact('website_title', 'header_title'));
    }

    public function websiteSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'website_title' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/instellingen'))->with('errors', $errors);
        }
        foreach(['website_title', 'header_title'] as $option_name) {
            if(Option::where('name', $option_name)->first()) {
                $option = Option::where('name', $option_name)->first();
                $option->update([
                    'value' => $request->input($option_name),
                ]);
            }
            else {
                Option::create([
                    'name' => $option_name,
                    'value' => $request->input($option_name),
                ]);
            }
        }
        return redirect(url('/admin/instellingen'));

    }

    public function openinghours() {
        return view('admin.settings.openinghours');
    }
}
