<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\ContactInformation;
use App\OpeningHour;

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

    public function openingHours($type = false, $day = false) {
        $query = $this->hasMany(OpeningHour::class);
        if($type) {
            $query = $query->where('type', $type);
        }
        if($day) {
            $query = $query->where('day', $day);
        }
        return $query;
    }
}
