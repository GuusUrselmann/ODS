<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\UserType;
use App\Permission;
use App\UserPermission;
use App\PermissionGroup;
use App\Group;
class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function users() {
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }

    public function add() {
        $user_types = UserType::all();
        $permissions = Permission::all();
        $groups = Group::all();
        $group_perms_array = [];
        foreach($user_types as $user_type) {
            $group = $user_type->group();
            $group_permissions = $group->permissions()->get();
            $perms_array = [];
            foreach($group_permissions as $permission) {
                array_push($perms_array, $permission->permission_id);
            }
            $group_perms_array[$group->id] = $perms_array;
        }
        return view('admin.users.add', compact('user_types', 'permissions', 'group_perms_array'));
    }

    public function save(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'require|max:50',
            'email' => 'require|email:rfc,dns|unique:users',
            'password' => 'require|max:50',
            'first_name' => 'require|max:50',
            'last_name' => 'require|max:50',
            'user_type_id' => 'require'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/gebruikers/toevoegen'))->with('errors', $errors);
        }
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_type_id' => $request->input('user_type_id')
        ]);

        $group = $user->user_type()->group();
        $group_permissions = $user->user_type()->group()->permissions()->get()->keyBy('id');
        $permissions = $request->input('permissions');
        foreach($permissions as $permission_id) {
            if(!$group->hasPermission($permission_id)) {
                UserPermission::create([
                    'user_id' => $user->id,
                    'permission_id' => $permission_id
                ]);
            }
            else {
                $group_permissions->pull($permission_id);
            }
        }
        foreach($group_permissions as $group_permission) {
            UserPermission::create([
                'user_id' => $user->id,
                'permission_id' => $group_permission->permission_id
            ]);
        }
        return redirect(url('/admin/gebruikers'));
    }

    public function edit($id) {
        $user = User::find($id);
        $user_types = UserType::all();
        $permissions = Permission::all();
        $groups = Group::all();
        $group_perms_array = [];
        foreach($user_types as $user_type) {
            $group = $user_type->group();
            $group_permissions = $group->permissions()->get();
            $perms_array = [];
            foreach($group_permissions as $permission) {
                array_push($perms_array, $permission->permission_id);
            }
            $group_perms_array[$group->id] = $perms_array;
        }
        return view('admin.users.edit', compact('user', 'user_types', 'permissions', 'group_perms_array'));
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            // add validate
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/gebruikers/toevoegen'))->with('errors', $errors);
        }
        $user = User::find($id);
        $user->update([
            'username' => $request->has('username') ? $request->input('username') : $user->username,
            'email' => $request->has('email') ? $request->input('email') : $user->email,
            'password' => $request->has('password') ? Hash::make($request->input('password')) : $user->password,
            'first_name' => $request->has('first_name') ? $request->input('first_name') : $user->first_name,
            'last_name' => $request->has('last_name') ? $request->input('last_name') : $user->last_name,
            'user_type_id' => $request->has('user_type_id') ? $request->input('user_type_id') : $user->user_type_id
        ]);

        $group = $user->user_type()->group();
        $group_permissions = $user->user_type()->group()->permissions()->get()->keyBy('permission_id');
        $permissions = $request->input('permissions');
        $user_permissions_stored = UserPermission::where('user_id', $user->id)->get();
        foreach($permissions as $permission_id) {
            if($group->hasPermission($permission_id)) {
                $group_permissions->pull($permission_id);
                if(UserPermission::where('user_id', $user->id)->where('permission_id', $permission_id)->count() > 0) {
                    $user_permission = UserPermission::where('user_id', $user->id)->where('permission_id', $permission_id)->first();
                    $user_permission->delete();
                    $user_permissions_stored->pull($permission_id);
                }
            }
            else {
                if(!UserPermission::where('user_id', $user->id)->where('permission_id', $permission_id)->count() > 0) {
                    UserPermission::create([
                        'user_id' => $user->id,
                        'permission_id' => $permission_id
                    ]);
                }
                $user_permissions_stored->pull($permission_id);
            }
        }
        foreach($group_permissions as $group_permission) {
            if(UserPermission::where('user_id', $user->id)->where('permission_id', $group_permission->permission_id)->count() == 0) {
                UserPermission::create([
                    'user_id' => $user->id,
                    'permission_id' => $group_permission->permission_id
                ]);
                $user_permissions_stored->pull($group_permission->permission_id);
            }
        }
        foreach($user_permissions_stored as $user_permission_stored) {
            if(UserPermission::where('user_id', $user->id)->where('permission_id', $user_permission_stored->permission_id)->count() > 0) {
                $user_permission = UserPermission::where('user_id', $user->id)->where('permission_id', $user_permission_stored->permission_id)->first();
                $user_permission->delete();
            }
        }
        return redirect(url('/admin/gebruikers'));
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/gebruikers');
    }
}



//permissies

/*
-group
-user


group:  1,2,5,6,
input:  1,2,3,6,7,9
stored: 1,2,3,4,6,7,9

pick group out of people

foreach input
1,2,6 -> 126 out of input array, AND out of group array
3,7,9 not in group, so extra permissions and belong in user_permissions
5 belongs to group but isn't in input, so we foreach the leftovers
foreach group
make new userpermissions

if userpermissions and group have the same permission stored, double negative

all:    1 2 3 4 5 6 7 8 9 0
prevg:  1 2 3   5
userp:      3 4   6       0
group:  1 2 3     6 7 8 9
input:  1 2   4 5 6 7 8

foreach input
1,2,6,7,8 -> take out of group array (3,9), if taken out, check if user_permission of it exists and remove it, and remove it from userp
4,5 -> not in group, so belong in user_permissions (check if exists already) and remove from userp array
foreach group
3,9 -> make (if not existing already) and remove from userp array
foreach userp
remove

1
1,2,3

*/
