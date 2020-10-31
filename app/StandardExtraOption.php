<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandardExtraOption extends Model
{
    protected $fillable = ['name', 'name_slug', 'extra_amount', 'standard_extra_id'];
}
