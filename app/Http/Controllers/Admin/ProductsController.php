<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function overview() {
        $products = Product::all();
        return view('admin.products.products', compact('products'));
    }

    public function add() {
        return view('admin.products.add');
    }

    public function edit() {
        return view('admin.products.edit');
    }

    /*
    *   Method to insert new categories into the datbase
    */
    public function save() {
        return redirect(url('/admin/products'));
    }

    /*
    *   Method to update existing categories into the datbase
    */
    public function update() {
        return redirect(url('/admin/products'));
    }

    public function delete() {
        return redirect(url('/admin/products'));
    }
}
