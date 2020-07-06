<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\UserType;
use App\Group;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'user_type_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_type() {
        return UserType::where('id', $this->user_type_id)->first();
    }

    public function permissions() {
        $user_permissions = UserPermission::where('user_id', $this->id)->get();
        $group_permissions = $this->user_type()->group()->permissions()->get();
        $permissions = [];
        foreach($user_permissions as $user_permission) {
            if(!$group_permissions->contains('permission_id', $user_permission->permission_id)) {
                array_push($permissions, $user_permission->permission_id);
            }
        }
        foreach($group_permissions as $group_permission) {
            if(!$user_permissions->contains('permission_id', $group_permission->permission_id)) {
                array_push($permissions, $group_permission->permission_id);
            }
        }
        return Permission::findMany($permissions);
    }

    public function hasPermission($permission_name) {
        if($this->permissions()->contains('slug', Str::slug($permission_name))) {
            return true;
        }
        return false;
    }
}
