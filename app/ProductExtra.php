<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductExtraOption;

class ProductExtra extends Model
{
    protected $fillable = ['name', 'name_slug', 'type', 'product_id'];

    public function options() {
        return $this->hasMany(ProductExtraOption::class);
    }
}
