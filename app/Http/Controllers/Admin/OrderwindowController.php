<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Order;

class OrderwindowController extends Controller
{
    public function orderwindow() {
        $orders = Order::with('order_products','contactInformation')->get();
        return view('admin.orderwindow.orderwindow', compact('orders'));
    }
}
