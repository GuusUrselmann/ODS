<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Product;
use App\Order;
use Cart;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function addProductToCart(Request $request) {
        if(!Product::find($request->product_id)) {
            return [
                'cart' => Cart::getContent()->sort(),
                'amount' => Cart::getTotal()
            ];
        }
        $cart_id = false;
        foreach(Cart::getContent() as $product) {
            if($product->attributes['product_id'] == $request->product_id) {
                $cart_id = $product->id;
                break;
            }
        }
        if($cart_id) {
            Cart::update($cart_id, [
                'quantity' => 1
            ]);
        }
        else {
            $product = Product::find($request->product_id);
            Cart::add([
                'id' => Cart::getContent()->isEmpty() ? 1 : array_key_last(Cart::getContent()->toArray())+1,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(
                    'product_id' => $product->id,
                    'image' => $product->image_path,
                )
            ]);
        }
        return [
            'cart' => Cart::getContent()->sort(),
            'amount' => Cart::getTotal()
        ];
    }

    public function removeProductFromCart(Request $request) {
        Cart::remove($request->row_id);
        return [
            'cart' => Cart::getContent()->sort(),
            'amount' => Cart::getTotal()
        ];
    }

    public function updateProductQuantityInCart(Request $request) {
        Cart::update($request->row_id, [
            'quantity' => $request->quantity
        ]);
        return [
            'cart' => Cart::getContent()->sort(),
            'amount' => Cart::getTotal()
        ];
    }

    public function orderList(Request $request) {
        $orders = Order::with('order_products')->get();
        return [
            'orders' => $orders
        ];
    }
}
