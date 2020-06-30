<?php

namespace App\Http\Controllers\Couponcodes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Couponcodes extends Controller
{
  public function __construct()
  {
    
  }

  public function overview() {
    return view('admin.couponcodes.overview');
  }
}
