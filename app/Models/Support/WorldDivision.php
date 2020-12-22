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
        return $this->belongsTo(WorldCountry::class);
    }

    public function city(){  
        return $this->belongsTo(WorldCity::class);
    }
}
