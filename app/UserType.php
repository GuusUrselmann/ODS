<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class UserType extends Model
{
    public function group() {
        return Group::where('id', $this->group_id)->first();
    }
}
