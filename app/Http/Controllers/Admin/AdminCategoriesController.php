<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function categories() {
        return view('admin.categories.categories');
    }

    public function categoryAdd() {
        return view('admin.categories.add');
    }

    public function categoryEdit() {
        return view('admin.categories.edit');
    }

    public function categoryAddSave() {
        return redirect(url('/admin/categories'));
    }

    public function categoryEditSave() {
        return redirect(url('/admin/categories'));
    }

    public function categoryDelete() {
        return redirect(url('/admin/categories'));
    }
}
