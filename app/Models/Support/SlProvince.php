<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlProvince extends Model
{
    use HasFactory;

    protected $table = 'sl_provinces';

    public function district(){
        return $this->hasMany(SlDistrict::class, 'province_id', 'id');
    }
}
