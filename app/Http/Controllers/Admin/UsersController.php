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
            // add validate
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/gebruikers/toevoegen'))->with('errors', $errors);
        }
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_type_id' => $request->input('user_type_id')
        ]);
        $group = $user->user_type()->group();
        $permission_groups = $request->input('permissions');
        $group_perms_array = $group->permissions()->get()->keyBy('id');
        foreach($permission_groups as $permission_id) {
            if(!$group->hasPermission($permission_id)) {
                UserPermission::create([
                    'user_id' => $user->id,
                    'permission_id' => $permission_id
                ]);
            }
            else {
                $group_perms_array->pull($permission_id);
            }
        }
        foreach($group_perms_array as $group_perm) {
            UserPermission::create([
                'user_id' => $user->id,
                'permission_id' => $group_perm->permission_id
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
            'email' => $request->has('email') ? $request->input('email') : $user->email,
            'password' => $request->has('password') ? Hash::make($request->input('password')) : $user->password,
            'first_name' => $request->has('first_name') ? $request->input('first_name') : $user->first_name,
            'last_name' => $request->has('last_name') ? $request->input('last_name') : $user->last_name,
            'user_type_id' => $request->has('user_type_id') ? $request->input('user_type_id') : $user->user_type_id
        ]);
        $group = $user->user_type()->group();
        $permission_groups = $request->input('permissions');
        $group_perms_array = $group->permissions()->get()->keyBy('id');
        foreach($permission_groups as $permission_id) {
            if(!$group->hasPermission($permission_id)) {
                UserPermission::create([
                    'user_id' => $user->id,
                    'permission_id' => $permission_id
                ]);
            }
            else {
                $group_perms_array->pull($permission_id);
            }
        }
        foreach($group_perms_array as $group_perm) {
            UserPermission::create([
                'user_id' => $user->id,
                'permission_id' => $group_perm->permission_id
            ]);
        }
        return redirect(url('/admin/gebruikers'));
        dd();
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/gebruikers');
    }
}
