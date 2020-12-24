<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlDistrict extends Model
{
    use HasFactory;

    protected $table = 'sl_districts';

    public function province(){
        return $this->belongsTo(SlProvince::class, 'province_id', 'id');
    }
    public function city(){
        return $this->hasMany(SlCity::class, 'district_id', 'id');
    }
}
