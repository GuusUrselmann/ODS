<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\ContactInformation;

class Branch extends Model
{
    //
    protected $fillable = ['name', 'email', 'cash', 'card', 'ideal', 'invoice', 'takeaway', 'delivery', 'delivery_fee_at', 'delivery_free_at', 'delivery_min_amount', 'delivery_areas'];

    public function contactInformation() {
        return $this->belongsTo(ContactInformation::class);
    }

    public function deliveryAreas() {
        return explode(',', $this->delivery_areas);
    }
}
