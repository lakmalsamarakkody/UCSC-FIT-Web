<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlCity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sl_cities';

    public function district(){
        return $this->belongsTo(SlDistrict::class, 'district_id', 'id');
    }
}
