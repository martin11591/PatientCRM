<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public $timestamps = false;

    public $guarded = [];

    // public $hidden = [
    //     'user_id',
    //     'birth_zip_code',
    //     'birth_city',
    //     'birth_country',
    //     'registered_zip_code',
    //     'registered_city',
    //     'registered_country',
    //     'correspondence_zip_code',
    //     'correspondence_city',
    //     'correspondence_country',
    // ];
}
