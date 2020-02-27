<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public $timestamps = false;
    public $guarded = [];
    
    public function groups()
    {
        return $this->belongsToMany('App\MedicineGroup', 'medicine_to_group', 'medicine_id', 'group_medicine_id');
    }
}
