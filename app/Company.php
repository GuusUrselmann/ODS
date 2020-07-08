<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public function contact_information() {
        return $this->hasOne('App\ContactInformation', 'id', 'contact_information_id');
    }
}
