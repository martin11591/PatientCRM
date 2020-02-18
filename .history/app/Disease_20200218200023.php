<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function groups() {
        return $this->belongsToMany('App\DiseaseGroup');
    }
}
