<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class MenuProduct extends Model
{
    protected $fillable = ['position', 'product_id', 'menu_id', 'menu_category_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
