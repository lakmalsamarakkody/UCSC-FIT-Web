<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlDistrict extends Model
{
    use HasFactory;

    protected $table = 'sl_districts';

    public function province(){
        return $this->belongsTo(SlProvince::class);
    }
    public function city(){
        return $this->hasMany(SlCity::class);
    }
}
