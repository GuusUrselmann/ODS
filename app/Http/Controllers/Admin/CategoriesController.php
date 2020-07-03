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
        $categories = [
            [
                'id' => 1,
                'name' => 'Voorgerechten',
                'status' => "active",
                'created_at' => "02/07/2020",
                'updated_at' => null,
                'deleted_at' => null,
                'webshop_position' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Hoofdgerechten',
                'status' => "active",
                'created_at' => "02/07/2020",
                'updated_at' => null,
                'deleted_at' => null,
                'webshop_position' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Nagerechten',
                'status' => "active",
                'created_at' => "02/07/2020",
                'updated_at' => null,
                'deleted_at' => null,
                'webshop_position' => 3,
            ],
        ];

        return view('admin.categories.overview', ['categories' => $categories]);
    }

    public function add()
    {
        return view('admin.categories.add');
    }

    public function edit()
    {
        $category = [
            'id' => 1,
            'name' => 'Voorgerechten',
            'status' => "inactive",
            'created_at' => "02/07/2020",
            'updated_at' => null,
            'deleted_at' => null,
            'webshop_position' => 1,
        ];

        return view('admin.categories.edit', [ 'category' => $category]);
    }

    /*
    *   Method to insert new categories into the datbase
    */
    public function save()
    {
        return redirect(url('/admin/categorieen'));
    }

    /*
    *   Method to update existing categories into the datbase
    */
    public function update()
    {
        return redirect(url('/admin/categorieen'));
    }

    public function delete()
    {
        return redirect(url('/admin/categorieen'));
    }
}
