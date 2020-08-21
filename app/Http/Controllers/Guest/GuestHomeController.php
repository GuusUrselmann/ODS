<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Menu;
use App\Order;
use App\OrderProduct;
use Cart;

class GuestHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function home(Request $request) {
        $menu = Menu::find(1);
        $cart = Cart::getContent();
        $cart->sort();
        $cart_amount = Cart::getTotal();
        return view('guest.home.home', compact('menu', 'cart', 'cart_amount'));
    }

    public function order(Request $request) {
        $cart = Cart::getContent();
        $cart->sort();
        $cart_amount = Cart::getTotal();
        return view('guest.order.order', compact('cart', 'cart_amount'));
    }

    public function placeOrder(Request $request) {
        $order_uuid = Str::random(8);

        $next_order_id = Order::latest('id')->first() ? Order::latest('id')->first()->id + 1 : 1;
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => strval(number_format(Cart::getTotal(),2)) // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Bestelling ODS #".$next_order_id,
            "redirectUrl" => url('bestelling/'.$order_uuid),
            "metadata" => [
                "order_id" => $next_order_id,
            ],
        ]);

        $order = Order::create([
            'amount' => Cart::getTotal(),
            'order_datetime' => Carbon::now(),
            'user_id' => 1,
            'status' => 'in_process',
            'payment_method' => 'card',
            'paid' => true,
            'mollie_payment_id' => $payment->id,
            'uuid' => $order_uuid
        ]);

        foreach(Cart::getContent() as $cart_item) {
            OrderProduct::create([
                'quantity' => $cart_item->quantity,
                'order_id' => $order->id,
                'product_id' => $cart_item->attributes['product_id'],
            ]);
        }

        $payment = Mollie::api()->payments->get($payment->id);

        Cart::clear();

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function trackOrder($id) {
        $order = Order::where('uuid', $id)->first();
        dd($order);
    }
}
