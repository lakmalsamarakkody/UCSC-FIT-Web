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
        return $this->belongsTo(WorldCountry::class, 'country_id', 'id');
    }

    public function city(){  
        return $this->hasMany(WorldCity::class, 'division_id', 'id');
    }
    public function student_permanent(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'permanent_state_id', 'id');
    }
    public function student_current(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'current_state_id', 'id');
    }
}
