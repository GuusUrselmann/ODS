<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Validator;
use App\Product;
use App\Category;
use App\CategoryProduct;
use App\Menu;

class MenusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function menus() {
        $menus = Menu::all();
        return view('admin.menus.menus', compact('menus'));
    }

    public function add() {
        $categories = Category::all();
        return view('admin.menus.add');
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/menus/toevoegen'))->with('errors', $errors);
        }
        Menu::create([
            'name' => $request->input('name')
        ]);
        return redirect(url('/admin/menus'));
    }

    public function edit($id) {
        $menu = Menu::find($id);
        return view('admin.menus.edit', compact('menu'));
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/menus/bewerken/'.$id))->with('errors', $errors);
        }
        $menu = Menu::find($id);
        $menu->update([
            'name' => $request->input('name')
        ]);

        return redirect(url('/admin/menus'));
    }

    public function delete($id) {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect(url('/admin/menus'));
    }
}
