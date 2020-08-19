<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\CategoryProduct;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'price', 'image_path'];

    public function hasCategory($category) {
        if(is_int($category) && CategoryProduct::where('category_id', $category)->where('product_id', $this->id)->first()) {
            return true;
        }
        elseif(is_string($category)) {
            if(Category::where('name', $category)->first()) {
                $category = Category::where('name', $category)->first();
                if(CategoryProduct::where('category_id', $category->id)->where('product_id', $this->id)->first()) {
                    return true;
                }
            }
        }
        return false;
    }
}
