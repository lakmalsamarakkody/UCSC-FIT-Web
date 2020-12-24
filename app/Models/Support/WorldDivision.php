<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorldDivision extends Model
{
    use HasFactory;

    protected $table='world_divisions';

    public function country(){  
        return $this->belongsTo(WorldCountry::class, 'id', 'country_id');
    }

    public function city(){  
        return $this->hasMany(WorldCity::class, 'division_id', 'id');
    }
}
