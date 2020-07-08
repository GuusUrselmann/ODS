<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Branch;

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

    public function categories() {
        $categories = Category::all();
        return view('admin.categories.categories', compact('categories'));
    }

    public function add() {
        $branches = Branch::all();

        return view('admin.categories.add', ['branches' => $branches]);
    }

    public function edit()
    {
        $category = Category::find(request('id'));
        $branches = Branch::all();

        return view('admin.categories.edit', [
            'category' => $category,
            'branches' => $branches
        ]);
    }

    /*
    *   Method to insert new categories into the datbase
    */
    public function save()
    {
        $highestPosition = Category::where('status', 'active')->max('webshop_position');

        $category = new Category();

        $category->name = request('name');
        $category->status = request('status');
        $category->branch_id = request('branch_id');
        $category->webshop_position = $highestPosition + 1;

        $category->save();

        return redirect(url('/admin/categorieen'));
    }

    /*
    *   Method to update existing categories into the datbase
    */
    public function update()
    {
        $category = Category::find(request('id'));

        $category->name = request('name');
        $category->status = request('status');
        $category->branch_id = request('branch_id');

        $category->save();

        return redirect(url('/admin/categorieen'));
    }

    public function delete()
    {
        return redirect(url('/admin/categorieen'));
    }
}
