<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        $website_title = Option::where('name', 'website_title')->first() ? Option::where('name', 'website_title')->first()->value : '';
        $header_title = Option::where('name', 'header_title')->first() ? Option::where('name', 'header_title')->first()->value : '';
        $website_logo = Option::where('name', 'website_logo')->first() ? Option::where('name', 'website_logo')->first()->value : '';
        $home_background = Option::where('name', 'home_background')->first() ? Option::where('name', 'home_background')->first()->value : '';
        return view('admin.settings.website', compact('website_title', 'header_title', 'website_logo', 'home_background'));
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
            if($request->input($option_name) != null) {
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
        }
        if($request->has('website_logo')) {
            $image = $request->file('website_logo');
            $image_extention = '.jpg';
            $image_path = public_path('/images/site/');
            if(File::exists($image_path.'logo'.$image_extention)) {
                File::delete($image_path.'logo'.$image_extention);
            }
            $image->move($image_path, 'logo'.$image_extention);
            $option = Option::where('name', 'website_logo')->first();
            if($option) {
                $option->update([
                    'value' => '/images/site/logo'.$image_extention,
                ]);
            }
            else {
                Option::create([
                    'name' => 'website_logo',
                    'value' => '/images/site/logo'.$image_extention,
                ]);
            }
        }
        if($request->has('home_background')) {
            $image = $request->file('home_background');
            $image_extention = '.jpg';
            $image_path = public_path('/images/site/');
            if(File::exists($image_path.'banner-home'.$image_extention)) {
                File::delete($image_path.'banner-home'.$image_extention);
            }
            $image->move($image_path, 'banner-home'.$image_extention);
            $option = Option::where('name', 'home_background')->first();
            if($option) {
                $option->update([
                    'value' => '/images/site/banner-home'.$image_extention,
                ]);
            }
            else {
                Option::create([
                    'name' => 'home_background',
                    'value' => '/images/site/banner-home'.$image_extention,
                ]);
            }
        }
        return redirect(url('/admin/instellingen'));

    }

    public function openinghours() {
        return view('admin.settings.openinghours');
    }
}
