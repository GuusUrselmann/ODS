<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couponcode extends Model
{
    protected $fillable = ['code', 'amount', 'type', 'sort', 'min_amount_spent'];
}
