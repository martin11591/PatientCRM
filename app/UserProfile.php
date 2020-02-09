<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public $primaryKey = 'user_id';
    public $timestamps = false;

    public $guarded = ['email'];

    public function getRouteKeyName() {
        return 'user_id';
    }
}
