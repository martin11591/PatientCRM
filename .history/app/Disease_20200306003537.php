<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public $timestamps = false;
    public $guarded = [];
    
    public function groups()
    {
        return $this->belongsToMany('App\DiseaseGroup', 'disease_to_group', 'disease_id', 'disease_group_id');
    }

    /**
     * METHODS FOR MODEL
     *
    protected function index(int $perPage = 10) {
        if (is_nan($perPage)) $perPage = 10;
        return self::with('groups')->paginate($perPage);
    }*/
}
