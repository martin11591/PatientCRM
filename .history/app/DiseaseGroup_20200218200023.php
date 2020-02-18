<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseGroup extends Model
{
    public function diseases() {
        return $this->belongsToMany('App\Disease');
    }
}
