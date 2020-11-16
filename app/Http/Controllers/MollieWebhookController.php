<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use App\Order;

class MollieWebhookController extends Controller {
    public function handle(Request $request) {
        if (! $request->has('id')) {
            return;
        }
        $payment = Mollie::api()->payments()->get($request->id);
        if ($payment->isPaid()) {
            $order = Order::find($payment->metadata->order_id);
            if(!$order) {
                return;
            }
            $order->update([
                'paid' => true
            ]);
            Mail::to(Auth::check() ? Auth::user()->email : $order->contactInformation->email)->send(new OrderConfirm());
        }
    }
}
