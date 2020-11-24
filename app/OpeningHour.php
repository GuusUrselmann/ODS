<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    //
    protected $fillable = ['day', 'type', 'open', 'from', 'till', 'branch_id'];

}
