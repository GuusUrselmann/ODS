<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\MenuCategory;

class Menu extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function menuCategories() {
        return $this->hasMany(MenuCategory::class);
    }

    public function list() {
        $list = $this->menuCategories()->with('category', 'menuProducts')->get();
        return $list;
    }
}
