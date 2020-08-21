<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderProduct extends Model
{
    protected $fillable = ['quantity', 'order_id', 'product_id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
