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
use App\MenuCategory;
use App\MenuProduct;

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
        $products = Product::all();
        return view('admin.menus.add', compact('categories', 'products'));
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/menus/toevoegen'))->with('errors', $errors);
        }
        $menu = Menu::create([
            'name' => $request->input('name')
        ]);

        if($request->input('categories')) {
            $position = 1;
            foreach($request->input('categories') as $key => $products) {
                $category = Category::find($key);
                $menu_category = MenuCategory::create([
                    'position' => $position,
                    'menu_id' => $menu->id,
                    'category_id' => $category->id,
                ]);
                $position++;
                $product_position = 1;
                foreach($products as $product_id) {
                    $product = Product::find($product_id);
                    MenuProduct::create([
                        'position' => $product_position,
                        'product_id' => $product->id,
                        'menu_id' => $menu->id,
                        'menu_category_id' => $menu_category->id,
                    ]);
                    $product_position++;
                }
            }
        }

        return redirect(url('/admin/menus'));
    }

    public function edit($id) {
        $menu = Menu::find($id);
        $categories = Category::all();
        $products = Product::all();
        $menu_list = $menu->list();
        return view('admin.menus.edit', compact('menu', 'categories', 'products', 'menu_list'));
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
        if($request->input('categories')) {
            $position = 1;
            //all categories from DB 1,2,3
            //all submitted categories 2,3,4
            //subtract submitted from categories in db
            // 1,4
            $menu_categories_stored = $menu->menuCategories()->get()->keyBy('category_id');
            foreach($request->input('categories') as $category_id => $product_ids) {
                if(MenuCategory::where('menu_id', $menu->id)->where('category_id', $category_id)->first()) {
                    //menu_category exists already
                    $menu_category = MenuCategory::where('menu_id', $menu->id)->where('category_id', $category_id)->first();
                    $menu_categories_stored->pull($menu_category->category_id);
                    //check/update product logic inside menu_category
                    $product_position = 1;
                    $menu_products_stored = $menu_category->menuProducts()->get()->keyBy('product_id');
                    foreach($product_ids as $product_id) {
                        if(MenuProduct::where('menu_id', $menu->id)->where('menu_category_id', $menu_category->id)->where('product_id', $product_id)->first()) {
                            //product already exists
                            $menu_product = MenuProduct::where('menu_id', $menu->id)->where('menu_category_id', $menu_category->id)->where('product_id', $product_id)->first();
                            $menu_products_stored->pull($menu_product->product_id);
                        }
                        else {
                            //product does not exist already
                            MenuProduct::create([
                                'position' => $product_position,
                                'product_id' => $product_id,
                                'menu_id' => $menu->id,
                                'menu_category_id' => $menu_category->id,
                            ]);
                        }
                        $product_position++;
                    }
                    //remove deleted products
                    foreach($menu_products_stored as $menu_product_stored) {
                        $menu_product_stored->delete();
                    }
                }
                else {
                    //menu_category does not exist already
                    $menu_category = MenuCategory::create([
                        'position' => $position,
                        'menu_id' => $menu->id,
                        'category_id' => $category_id,
                    ]);
                    $product_position = 1;
                    foreach($product_ids as $product_id) {
                        MenuProduct::create([
                            'position' => $product_position,
                            'product_id' => $product_id,
                            'menu_id' => $menu->id,
                            'menu_category_id' => $menu_category->id,
                        ]);
                        $product_position++;
                    }
                }
                $position++;
            }
            //remove deleted categories
            foreach($menu_categories_stored as $menu_category_stored) {
                $menu_category_stored->delete();
            }
        }

        return redirect(url('/admin/menus'));
    }

    public function delete($id) {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect(url('/admin/menus'));
    }
}
