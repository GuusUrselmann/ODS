<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function overview()
    {
        return view('admin.categories.categories');
    }

    public function add()
    {
        return view('admin.categories.add');
    }

    public function edit()
    {
        return view('admin.categories.edit');
    }

    /*
    *   Method to insert new categories into the datbase
    */
    public function save()
    {
        return redirect(url('/admin/categories'));
    }

    /*
    *   Method to update existing categories into the datbase
    */
    public function update()
    {
        return redirect(url('/admin/categories'));
    }

    public function delete()
    {
        return redirect(url('/admin/categories'));
    }
}
