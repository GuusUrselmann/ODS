<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;
use App\Category;

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
        return view('admin.categories.add');
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/categorieen/toevoegen'))->with('errors', $errors);
        }
        Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '_')
        ]);
        return redirect(url('/admin/categorieen'));
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/categorieen/bewerken/'.$id))->with('errors', $errors);
        }
        $category = Category::find($id);
        $category->update([
            'name' => $request->has('name') ? $request->input('name') : $category->name,
            'slug' => $request->has('name') ? Str::slug($request->input('name'), '_') : $category->slug,
        ]);
        return redirect(url('/admin/categorieen'));
    }

    public function delete($id) {
        $category = Category::find($id);
        $category->delete();
        return redirect(url('/admin/categorieen'));
    }
}
