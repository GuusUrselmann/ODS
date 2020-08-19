<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\MenuProduct;

class MenuCategory extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function menuProducts() {
        return $this->hasMany(MenuProduct::class)->with('product');
    }
}
