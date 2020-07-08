<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;
use App\Group;
use App\Permission;
use App\PermissionGroup;
use App\UserPermission;
use App\User;

class PermissionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function groups() {
        $groups = Group::all();
        return view('admin.permissions.groups', compact('groups'));
    }

    public function groupAdd() {
        $permissions = Permission::all();
        return view('admin.permissions.groupAdd', compact('permissions'));
    }

    public function groupSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'permissions' => 'required|array'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/permissies/groepen/toevoegen'))->with('errors', $errors);
        }
        $group = Group::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '_')
        ]);
        foreach($request->input('permissions') as $permission_id) {
            PermissionGroup::create([
                'permission_id' => $permission_id,
                'group_id' => $group->id
            ]);
        }
        return redirect(url('/admin/permissies/groepen/'));
    }

    public function groupEdit($id) {
        $group = Group::find($id);
        $permissions = Permission::all();
        return view('admin.permissions.groupEdit', compact('group', 'permissions'));
    }

    public function groupUpdate($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'permissions' => 'required|array'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/permissies/groepen/bewerken/'.$id))->with('errors', $errors);
        }
        $group = Group::find($id);
        $group->update([
            'name' => $request->has('name') ? $request->input('name') : $group->name,
            'slug' => $request->has('name') ? Str::slug($request->input('name'), '_') : $group->name
        ]);
        $group_permissions = $group->permissions()->get()->keyBy('id');
        foreach($request->input('permissions') as $permission_id) {
            if(!$group->hasPermission($permission_id)) {
                PermissionGroup::create([
                    'permission_id' => $permission_id,
                    'group_id' => $group->id
                ]);
            }
            $group_permission = PermissionGroup::where('permission_id', $permission_id)->where('group_id', $group->id)->first();
            $group_permissions->pull($group_permission->id);
        }
        foreach($group_permissions as $group_permission) {
            if($group->hasPermission($group_permission->permission_id)) {
                $group_permission->delete();
            }
        }
        return redirect(url('/admin/permissies/groepen/'));
    }

    public function groupDelete($id) {
        $group = Group::find($id);
        $group->delete();
        return redirect('/admin/permissies/groepen');
    }

    public function users() {
        $users = User::all();
        return view('admin.permissions.users', compact('users'));
    }
}
