<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlCity extends Model
{
    use HasFactory;

    protected $table = 'sl_cities';

    public function district(){
        return $this->belongsTo(SlDistrict::class);
    }
}
