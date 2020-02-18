<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function groups()
    {
        return $this->belongsToMany('App\MedicineGroup', 'medicine_to_group', 'medicine_id', 'medicine_group_id');
    }
}
