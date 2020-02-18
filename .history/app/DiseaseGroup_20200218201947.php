<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseGroup extends Model
{
    public $table = 'group_diseases';

    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'disease_to_group', 'disease_group_id', 'disease_id');
    }
}
