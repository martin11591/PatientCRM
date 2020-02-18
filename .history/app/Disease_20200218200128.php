<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function groups() {
        return $this->belongsToMany('App\DiseaseGroup', 'disease_group_id', 'disease_id', 'disease_to_group');
    }
}
