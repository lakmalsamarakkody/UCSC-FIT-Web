<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorldCity extends Model
{
    use HasFactory;

    protected $table='world_cities';

    public function country(){
        return $this->belongsTo(WorldCountry::class);
    }

    public function division(){
        return $this->belongsTo(WorldDivision::class);
    }
}
