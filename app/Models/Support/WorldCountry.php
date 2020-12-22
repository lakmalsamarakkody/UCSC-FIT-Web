<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorldCountry extends Model
{
    use HasFactory;

    protected $table='world_countries';

    public function division()
    {
        return $this->hasMany(WorldDivision::class);
    }

    public function city()
    {
        return $this->hasMany(WorldCity::class);
    }
}
