<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;

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

    public function groupEdit() {
        return view('admin.permissions.groupEdit');
    }

    public function groupUpdate() {
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
