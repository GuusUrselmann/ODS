<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;
use App\Group;
use App\Permission;
use App\PermissionGroup;

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
        return view('admin.permissions.groupAdd');
    }

    public function groupSave() {
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
            //Permission doesn't exist yet in group, add
            if(!$group->hasPermission($permission_id)) {
                PermissionGroup::create([
                    'permission_id' => $permission_id,
                    'group_id' => $group->id
                ]);
            }
            //Permission removed from active permissions
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
        return view('admin.permissions.users');
    }
}
