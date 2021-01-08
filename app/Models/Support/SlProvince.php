<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlProvince extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sl_provinces';

    public function district(){
        return $this->hasMany(SlDistrict::class, 'province_id', 'id');
    }
}
