<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    //
    protected $fillable = ['street_name', 'house_number', 'zipcode', 'city', 'phone', 'email'];
}
