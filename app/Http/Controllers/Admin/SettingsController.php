<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function general() {
        return view('admin.settings.settings');
    }

    public function openinghours() {
        return view('admin.settings.openinghours');
    }
}
