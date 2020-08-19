<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use App\Menu;
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
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => Cart::getTotal() // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Bestelling ODS",
            "redirectUrl" => url('home'),
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);

        $payment = Mollie::api()->payments->get($payment->id);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }
}
