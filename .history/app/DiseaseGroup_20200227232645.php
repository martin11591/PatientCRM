<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseGroup extends Model
{
    protected $table = 'group_diseases';
    protected $guarded = ['id'];
    protected $timestamps = false;

    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'disease_to_group', 'disease_group_id', 'disease_id');
    }
}
