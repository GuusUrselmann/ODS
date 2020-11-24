<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Product;
use App\Order;
use App\StandardExtra;
use App\StandardExtraOption;
use App\ProductExtra;
use App\ProductExtraOption;
use App\Couponcode;
use App\Branch;
use Cart;
use Illuminate\Support\Collection;

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

    public function getCart() {
        $conditions = Cart::getConditions();
        $data_conditions = [];
        foreach($conditions as $condition)
        $data_conditions[] = [
            'target' => $condition->getTarget(),
            'name' => $condition->getName(),
            'type' => $condition->getType(),
            'value' => $condition->getValue(),
            'attributes' => $condition->getAttributes(),
        ];
        return [
            'cart' => Cart::getContent()->sort(),
            'conditions' => $data_conditions,
            'amount' => Cart::getTotal()
        ];
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
                if($product->attributes['extra_options'] == $request->extra_options) {
                    $cart_id = $product->id;
                    break;
                }

            }
        }
        if($cart_id) {
            Cart::update($cart_id, [
                'quantity' => 1
            ]);
        }
        else {
            $product = Product::find($request->product_id);
            $attributes = [
                'product_id' => $product->id,
                'image' => $product->image_path,
                'extra_options' => []
            ];
            $price = $product->price;
            if(!empty($request->extra_options)) {
                foreach($request->extra_options as $extra_option) {
                    if($extra_option['type'] == 'standard_extra') {
                        $standard_extra = StandardExtra::find($extra_option['id']);
                        $standard_extra_options = StandardExtraOption::find($extra_option['value']);
                        $name = "";
                        $standard_extra_price = 0.00;
                        if($standard_extra_options instanceof Collection) {
                            foreach($standard_extra_options as $i => $standard_extra_option) {
                                if($i == 0) {
                                    $name .= $standard_extra_option->name;
                                    if($standard_extra_option->extra_amount > 0) {
                                        $name .= ' (+ €'.$standard_extra_option->extra_amount.')';
                                    }
                                }
                                else {
                                    $name .= ','.$standard_extra_option->name;
                                    if($standard_extra_option->extra_amount > 0) {
                                        $name .= ' (+ €'.$standard_extra_option->extra_amount.')';
                                    }
                                }
                                $standard_extra_price += $standard_extra_option->extra_amount;
                                $price += $standard_extra_option->extra_amount;
                            }
                        }
                        else {
                            $name .= $standard_extra_options->name;
                            if($standard_extra_options->extra_amount > 0) {
                                $name .= ' (+ €'.$standard_extra_options->extra_amount.')';

                            }
                            $standard_extra_price += $standard_extra_options->extra_amount;
                            $price += $standard_extra_options->extra_amount;
                        }
                        $attributes['extra_options'][] = [
                            'option' => $standard_extra->name,
                            'name' => $name,
                            'extra_amount' => $standard_extra_price,
                        ];

                    }
                    else {
                        $product_extra = ProductExtra::find($extra_option['id']);
                        // $product_extra_options = ProductExtraOption::find($extra_option['value'])->toArray();
                        $product_extra_options = ProductExtraOption::find($extra_option['value']);
                        $name = "";
                        $extra_option_price = 0.00;
                        if($product_extra_options instanceof Collection) {
                            foreach($product_extra_options as $i => $product_extra_option) {
                                if($i == 0) {
                                    $name .= $product_extra_option->name;
                                    if($product_extra_option->extra_amount > 0) {
                                        $name .= ' (+ €'.$product_extra_option->extra_amount.')';
                                    }
                                }
                                else {
                                    $name .= ','.$product_extra_option->name;
                                    if($product_extra_option->extra_amount > 0) {
                                        $name .= ' (+ €'.$product_extra_option->extra_amount.')';
                                    }
                                }
                                $extra_option_price += $product_extra_option->extra_amount;
                                $price += $product_extra_option->extra_amount;
                            }
                        }
                        else {
                            $name .= $product_extra_options->name;
                            if($product_extra_options->extra_amount > 0) {
                                $name .= ' (+ €'.$product_extra_options->extra_amount.')';
                            }
                            $extra_option_price += $product_extra_options->extra_amount;
                            $price += $product_extra_options->extra_amount;
                        }
                        $attributes['extra_options'][] = [
                            'option' => $product_extra->name,
                            'name' => $name,
                            'extra_amount' => $extra_option_price,
                        ];
                    }
                }
            }
            Cart::add([
                'id' => Cart::getContent()->isEmpty() ? 1 : array_key_last(Cart::getContent()->toArray())+1,
                'name' => $product->name,
                'price' => $price,
                'quantity' => 1,
                'attributes' => $attributes,
            ]);
        }
        return [
            'cart' => Cart::getContent()->sort(),
            'amount' => Cart::getTotal(),
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
        $orders = Order::with('order_products','contactInformation')->get();
        return [
            'orders' => $orders
        ];
    }

    public function setOrderStatus(Request $request) {
        $order = Order::find($request->order_id);
        $order->update([
            'status' => $request->order_status
        ]);
        return [
            'order' => $order
        ];
    }

    public function addCouponcodeToCart(Request $request) {
        if(Couponcode::where('code', $request->code)->first()) {
            $couponcode = Couponcode::where('code', $request->code)->first();
            if($couponcode->sort == 'amount') {
                $value = '-'.$couponcode->amount;
            }
            else {
                $value = $couponcode->amount.'%';
            }
            $couponCondition = new \Darryldecode\Cart\CartCondition([
                'name' => 'Coupon',
                'type' => 'coupon',
                'target' => 'total',
                'value'=> $value,
                'attributes' => [
                    'coupon_id' => $couponcode->id,
                ],
            ]);
            Cart::condition($couponCondition);
            return [
                'cart' => Cart::getContent()->sort(),
                'amount' => Cart::getTotal(),
                'test' => Couponcode::where('code', $request->code)->first(),
            ];
        }
        return [
            'cart' => Cart::getContent()->sort(),
            'amount' => Cart::getTotal(),
        ];
    }

    public function setOrderType(Request $request) {
        session(['order_type' => $request->order_type]);
    }

    public function validateZipcode(Request $request) {
        $branch = Branch::find(1);
        $areas = $branch->deliveryAreas();
        foreach($areas as $zipcode) {
            if($zipcode == substr($request->zipcode, 0, -2)) {
                session(['order_type' => $request->order_type]);
                return [
                    'validated' => true,
                ];
            }
        }
        return [
            'validated' => false,
        ];
    }
}
