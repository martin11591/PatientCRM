<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function groups()
    {
        return $this->belongsToMany('App\DiseaseGroup', 'disease_to_group', 'disease_id', 'disease_group_id');
    }
}
