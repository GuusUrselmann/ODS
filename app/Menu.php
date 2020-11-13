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

    public function homeList() {
        $list = $this->menuCategories()->with('category', 'menuProducts.product.standardExtras', 'menuProducts.product.extraOptions')->get();
        return $list;
    }

    public function list() {
        $list = $this->menuCategories()->with('category', 'menuProducts.product')->get();
        return $list;
    }
}
