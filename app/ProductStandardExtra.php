<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StandardExtra;

class ProductStandardExtra extends Model
{
    protected $fillable = ['product_id', 'standard_extra_id'];

    public function standardExtra() {
        return $this->belongsTo(StandardExtra::class);
    }
}
