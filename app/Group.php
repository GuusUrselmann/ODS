<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\PermissionGroup;

class Group extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug'];

    public function permissions() {
        return $this->hasMany(PermissionGroup::class);
    }

    public function hasPermission($permission_id) {
        if($this->hasMany(PermissionGroup::class)->get()->contains('permission_id', $permission_id)) {
            return true;
        }
        return false;
    }
}
