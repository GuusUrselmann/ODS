<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Order;

class OrdersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function orders() {
        $orders = Order::all();
        return view('admin.orders.orders', compact('orders'));
    }
}
