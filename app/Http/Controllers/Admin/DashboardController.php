<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Branch;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        return view('admin.dashboard.dashboard');
    }

    public function setBranch($id) {
        $branch = Branch::find($id);
        $user = Auth::user();
        $user->update([
            'admin_current_branch_id' => $branch->id,
        ]);
        return redirect(url()->previous());
    }
}
