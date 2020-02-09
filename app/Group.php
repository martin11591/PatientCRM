<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * Get the users belonging to this group
     */
    public function users() {
        return $this->belongsToMany('App\User', 'user_to_group', 'group_id', 'user_id');
    }
}
