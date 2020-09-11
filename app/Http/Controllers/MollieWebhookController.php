<?php

use App\Http\Controllers\Controller;

class MollieWebhookController extends Controller {
    public function handle(Request $request) {
        if (! $request->has('id')) {
            return;
        }
        $payment = Mollie::api()->payments()->get($request->id);
        if ($payment->isPaid()) {

        }
    }
}
