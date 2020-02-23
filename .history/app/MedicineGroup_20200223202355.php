<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineGroup extends Model
{
    public $table = 'group_medicines';
    public $guarded = ['id'];
    public $timestamps = false;

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine', 'medicine_to_group', 'group_medicine_id', 'medicine_id');
    }
}
