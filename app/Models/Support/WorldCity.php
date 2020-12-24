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
        return $this->belongsTo(WorldCountry::class, 'id', 'country_id');
    }

    public function division(){
        return $this->belongsTo(WorldDivision::class, 'id', 'division_id');
    }
}
