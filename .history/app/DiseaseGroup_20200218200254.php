<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseGroup extends Model
{
    public function diseases() {
        return $this->belongsToMany('App\Disease', 'disease_to_group', 'disease_id', 'disease_group_id');
    }
}
