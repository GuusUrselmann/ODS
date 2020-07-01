<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function products() {
        return view('admin.products.products');
    }

    public function productAdd() {
        return view('admin.products.add');
    }

    public function productEdit() {
        return view('admin.products.edit');
    }

    public function productAddSave() {
        return redirect(url('/admin/products'));
    }

    public function productEditSave() {
        return redirect(url('/admin/products'));
    }

    public function productDelete() {
        return redirect(url('/admin/products'));
    }
}
