<?php

use App\Http\Controllers\Controller;
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
        }
    }
}
