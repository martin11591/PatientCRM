<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public $timestamps = false;

    public function getRouteKeyName() {
        return 'user_id';
    }
}
