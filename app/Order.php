<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\OrderProduct;
use App\User;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['amount', 'order_datetime', 'user_id', 'status', 'payment_method', 'contact_information_id', 'mollie_payment_id', 'paid', 'uuid'];

    public function order_products() {
        return $this->hasMany(OrderProduct::class)->with('product');
    }

    public function user() {
        return $this->belongsTo(User::class)->first();
    }

    public function contactInformation() {
        return $this->belongsTo(ContactInformation::class);
    }
}
