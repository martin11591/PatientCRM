<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineGroup extends Model
{
    protected $table = 'group_medicines';
    protected $guarded = ['id'];
    protected $timestamps = false;

    public function medicines()
    {
        return $this->belongsToMany('App\Medicine', 'medicine_to_group', 'group_medicine_id', 'medicine_id');
    }
}
