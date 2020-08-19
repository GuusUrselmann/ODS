<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Validator;
use App\Product;
use App\Category;
use App\CategoryProduct;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function products() {
        $products = Product::all();
        return view('admin.products.products', compact('products'));
    }

    public function add() {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/producten/toevoegen'))->with('errors', $errors);
        }
        $nextId = Product::max('id')+1;
        if($request->has('image_path')) {
            $product_image = $request->file('image_path');
            $image_name = 'product_'.$nextId;
            $image_extention = '.jpg';
            $image_path = public_path('/images/products/');
            $product_image->move($image_path, $image_name.$image_extention);
        }
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => str_replace(',', '.', $request->input('price')),
            'description' => $request->input('description'),
            'image_path' => $request->has('image_path') ? 'images/products/'.$image_name.$image_extention : ''
        ]);
        if($request->has('categories'))  {
            foreach($request->input('categories') as $category_id) {
                CategoryProduct::create([
                    'category_id' => $category_id,
                    'product_id' => $product->id
                ]);
            }
        }
        return redirect(url('/admin/producten'));
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'price' => 'required'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/producten/bewerken/'.$id))->with('errors', $errors);
        }
        if($request->has('image_path')) {
            $product_image = $request->file('image_path');
            $image_name = 'product_'.$id;
            $image_extention = '.jpg';
            $image_path = public_path('/images/products/');
            if(File::exists($image_path.$image_name.$image_extention)) {
                File::delete($image_path.$image_name.$image_extention);
            }
            $product_image->move($image_path, $image_name.$image_extention);
        }
        $product = Product::find($id);
        $product_categories = CategoryProduct::where('product_id', $product->id)->get()->keyBy('category_id');
        foreach($request->input('categories') as $category_id) {
            if($product->hasCategory($category_id)) {
                $product_categories->forget(2);
            }
            else {
                CategoryProduct::create([
                    'category_id' => $category_id,
                    'product_id' => $product->id
                ]);
            }
        }
        foreach($product_categories as $category) {
            $category->delete();
        }
        $product->update([
            'name' => $request->input('name'),
            'price' => str_replace(',', '.', $request->input('price')),
            'description' => $request->input('description'),
            'image_path' => $request->has('image_path') ? 'images/products/'.$image_name.$image_extention : $product->image_path
        ]);

        return redirect(url('/admin/producten'));
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect(url('/admin/producten'));
    }
}
