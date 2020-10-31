<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StandardExtraOption;

class StandardExtra extends Model
{
    protected $fillable = ['name', 'name_slug', 'type'];

    public function options() {
        return $this->hasMany(StandardExtraOption::class);
    }
}
