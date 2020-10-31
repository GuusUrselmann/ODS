<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use App\Menu;
use App\Order;
use App\OrderProduct;
use App\ContactInformation;
use Cart;

class GuestHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('inertia.guest');
    }

    public function home(Request $request) {
        $menu = Menu::find(1)->list();
        $cart = Cart::getContent();
        $cart->sort();
        $cart_amount = Cart::getTotal();
        return Inertia::render('Guest/Home/Home', [
            'menu' => $menu,
            'cart' => $cart,
            'amount' => $cart_amount
        ]);
    }

    public function order(Request $request) {
        $cart = Cart::getContent();
        $cart->sort();
        $cart_amount = Cart::getTotal();
        // return view('guest.order.order', compact('cart', 'cart_amount'));
        return Inertia::render('Guest/Order/Order', [
            'cart' => $cart,
            'amount' => $cart_amount
        ]);
    }

    public function placeOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'streetname' => 'required',
            'housenumber' => 'required',
            'zipcode' => 'postal_code:NL',
            'city' => 'required',
            'payment_method' => 'in:iDEAL,cash',
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/bestellen'))->with('errors', $errors);
        }
        if($request->input('payment_method') == 'cash') {
            $order_uuid = Str::random(8);
            $contact_information = ContactInformation::create([
                'street_name' => $request->input('streetname'),
                'house_number' => $request->input('housenumber'),
                'zipcode' => $request->input('zipcode'),
                'city' => $request->input('city'),
                'email' => $request->input('email'),
            ]);
            $order = Order::create([
                'amount' => Cart::getTotal(),
                'order_datetime' => Carbon::now(),
                'user_id' => 1,
                'status' => 'received',
                'type' => 'takeaway',
                'payment_method' => $request->input('payment_method'),
                'paid' => true,
                'contact_information_id' => $contact_information->id,
                'uuid' => $order_uuid
            ]);
            foreach(Cart::getContent() as $cart_item) {
                OrderProduct::create([
                    'quantity' => $cart_item->quantity,
                    'order_id' => $order->id,
                    'product_id' => $cart_item->attributes['product_id'],
                ]);
            }
            Cart::clear();
            return redirect(url('/bedankt/'.$order_uuid));
        }
        elseif($request->input('payment_method') == 'iDEAL') {
            $order_uuid = Str::random(8);
            $next_order_id = Order::latest('id')->first() ? Order::latest('id')->first()->id + 1 : 1;
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => strval(number_format(Cart::getTotal(),2)) // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Bestelling ODS #".$next_order_id,
                "redirectUrl" => url('bedankt/'.$order_uuid),
                'webhookUrl'   => url('webhooks/mollie'),
                "metadata" => [
                    "order_id" => $next_order_id,
                ],
            ]);
            $contact_information = ContactInformation::create([
                'street_name' => $request->input('streetname'),
                'house_number' => $request->input('housenumber'),
                'zipcode' => $request->input('zipcode'),
                'city' => $request->input('city'),
                'email' => $request->input('email'),
            ]);
            $order = Order::create([
                'amount' => Cart::getTotal(),
                'order_datetime' => Carbon::now(),
                'user_id' => 1,
                'status' => 'received',
                'type' => 'takeaway',
                'payment_method' => $request->input('payment_method'),
                'paid' => false,
                'mollie_payment_id' => $payment->id,
                'contact_information_id' => $contact_information->id,
                'uuid' => $order_uuid
            ]);
            foreach(Cart::getContent() as $cart_item) {
                OrderProduct::create([
                    'quantity' => $cart_item->quantity,
                    'order_id' => $order->id,
                    'product_id' => $cart_item->attributes['product_id'],
                ]);
            }
            Cart::clear();
            return redirect($payment->getCheckoutUrl(), 303);
        }



        // dd($request);
        //
        // $order_uuid = Str::random(8);
        //
        // $next_order_id = Order::latest('id')->first() ? Order::latest('id')->first()->id + 1 : 1;
        // $payment = Mollie::api()->payments->create([
        //     "amount" => [
        //         "currency" => "EUR",
        //         "value" => strval(number_format(Cart::getTotal(),2)) // You must send the correct number of decimals, thus we enforce the use of strings
        //     ],
        //     "description" => "Bestelling ODS #".$next_order_id,
        //     "redirectUrl" => url('bestelling/'.$order_uuid),
        //     "metadata" => [
        //         "order_id" => $next_order_id,
        //     ],
        // ]);
        //
        // $order = Order::create([
        //     'amount' => Cart::getTotal(),
        //     'order_datetime' => Carbon::now(),
        //     'user_id' => 1,
        //     'status' => 'in_process',
        //     'payment_method' => 'iDEAL',
        //     'paid' => true,
        //     'mollie_payment_id' => $payment->id,
        //     'uuid' => $order_uuid
        // ]);
        //
        // foreach(Cart::getContent() as $cart_item) {
        //     OrderProduct::create([
        //         'quantity' => $cart_item->quantity,
        //         'order_id' => $order->id,
        //         'product_id' => $cart_item->attributes['product_id'],
        //     ]);
        // }
        //
        // $payment = Mollie::api()->payments->get($payment->id);
        //
        // Cart::clear();
        //
        // // redirect customer to Mollie checkout page
        // return redirect($payment->getCheckoutUrl(), 303);
    }

    public function thanks($uuid) {
        $order = Order::where('uuid', $uuid)->first();
        if(!$order) {
            return redirect(url('/home'));
        }
        return Inertia::render('Guest/Order/Thanks', [
            'order' => $order,
        ]);
    }

    public function trackOrder($uuid) {
        $order = Order::where('uuid', $uuid)->with('contactInformation')->first();
        return Inertia::render('Guest/Order/Track', [
            'order' => $order,
        ]);
    }
}
