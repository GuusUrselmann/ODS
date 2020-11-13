<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Validator;
use App\Product;
use App\Category;
use App\CategoryProduct;
use App\StandardExtra;
use App\ProductStandardExtra;
use App\ProductExtra;
use App\ProductExtraOption;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct() {
         $this->middleware('auth');
     }

    public function products() {
        $products = Product::all();
        return view('admin.products.products', compact('products'));
    }

    public function add() {
        $categories = Category::all();
        $standard_extras = StandardExtra::with('options')->get();
        return view('admin.products.add', compact('categories', 'standard_extras'));
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
        if($request->has('extraOptions')) {
            foreach($request->input('extraOptions') as $extra_option) {
                if($extra_option['type'] == 'standardExtra') {
                    ProductStandardExtra::create([
                        'product_id' => $product->id,
                        'standard_extra_id' => $extra_option['standardExtraID']
                    ]);
                }
                else {
                    $product_extra = ProductExtra::create([
                        'name' => $extra_option['name'],
                        'name_slug' => Str::slug($extra_option['name'], '_'),
                        'type' => $extra_option['type'],
                        'product_id' => $product->id
                    ]);
                    foreach($extra_option['options'] as $option) {
                        $extra_amount = $option['extra_amount'] != null? $option['extra_amount'] : 0;
                        ProductExtraOption::create([
                            'name' => $option['name'],
                            'name_slug' => Str::slug($option['name'], '_'),
                            'extra_amount' => str_replace(',', '.', $extra_amount),
                            'product_extra_id' => $product_extra->id
                        ]);
                    }
                }
            }
        }
        return redirect(url('/admin/producten'));
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();
        $standard_extras = StandardExtra::with('options')->get();
        $product_extra_options = $product->optionsMerged();
        return view('admin.products.edit', compact('product', 'categories', 'standard_extras', 'product_extra_options'));
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
                $product_categories->forget($category_id);
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

        $stored_standard_extras = ProductStandardExtra::where('product_id', $product->id)->get()->keyBy('standard_extra_id');
        $stored_product_extras = ProductExtra::where('product_id', $product->id)->get()->keyBy('name_slug');
        foreach($request->input('extraOptions') as $extra_option) {
            if($extra_option['type'] == 'standardExtra') {
                if(ProductStandardExtra::where('product_id', $product->id)->where('standard_extra_id', $extra_option['standardExtraID'])->first()) {
                    $stored_standard_extras->forget($extra_option['standardExtraID']);
                }
                else {
                    ProductStandardExtra::create([
                        'product_id' => $product->id,
                        'standard_extra_id' => $extra_option['standardExtraID']
                    ]);
                }
            }
            else {
                if(ProductExtra::where('product_id', $product->id)->where('name_slug', Str::slug($extra_option['name'], '_'))->first()) {
                    $product_extra = ProductExtra::where('product_id', $product->id)->where('name_slug', Str::slug($extra_option['name'], '_'))->first();
                    $product_extra->update([
                        'name' => $extra_option['name'],
                        'name_slug' => Str::slug($extra_option['name'], '_'),
                        'type' => $extra_option['type'],
                        'product_id' => $product->id
                    ]);
                    $stored_product_extras->forget(Str::slug($extra_option['name']));
                    $stored_extra_options = ProductExtraOption::where('product_extra_id', $product_extra->id)->get()->keyBy('name_slug');
                    foreach($extra_option['options'] as $option) {
                        $extra_amount = $option['extra_amount'] != null? $option['extra_amount'] : 0;
                        if(ProductExtraOption::where('product_extra_id', $product_extra->id)->where('name_slug', Str::slug($option['name'], '_'))->first()) {
                            $product_extra_options = ProductExtraOption::where('product_extra_id', $product_extra->id)->where('name_slug', Str::slug($option['name'], '_'))->first();
                            $product_extra_options->update([
                                'name' => $option['name'],
                                'name_slug' => Str::slug($option['name'], '_'),
                                'extra_amount' => str_replace(',', '.', $extra_amount),
                                'product_extra_id' => $product_extra->id
                            ]);
                            $stored_extra_options->forget(Str::slug($option['name']));
                        }
                        else {
                            ProductExtraOption::create([
                                'name' => $option['name'],
                                'name_slug' => Str::slug($option['name'], '_'),
                                'extra_amount' => str_replace(',', '.', $extra_amount),
                                'product_extra_id' => $product_extra->id
                            ]);
                        }
                    }
                    foreach($stored_extra_options as $stored_extra_option) {
                        $stored_extra_option->delete();
                    }
                }
                else {
                    $product_extra = ProductExtra::create([
                        'name' => $extra_option['name'],
                        'name_slug' => Str::slug($extra_option['name'], '_'),
                        'type' => $extra_option['type'],
                        'product_id' => $product->id
                    ]);
                    foreach($extra_option['options'] as $option) {
                        $extra_amount = $option['extra_amount'] != null? $option['extra_amount'] : 0;
                        ProductExtraOption::create([
                            'name' => $option['name'],
                            'name_slug' => Str::slug($option['name'], '_'),
                            'extra_amount' => str_replace(',', '.', $extra_amount),
                            'product_extra_id' => $product_extra->id
                        ]);
                    }
                }
            }
        }
        foreach($stored_standard_extras as $stored_standard_extra) {
            $stored_standard_extra->delete();
        }
        foreach($stored_product_extras as $stored_product_extra) {
            $stored_product_extra->delete();
        }

        return redirect(url('/admin/producten'));
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect(url('/admin/producten'));
    }
}
