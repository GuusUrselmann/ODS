<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductExtraOption extends Model
{
    protected $fillable = ['name', 'name_slug', 'extra_amount', 'product_extra_id'];
}
