<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class WorldCity extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table='world_cities';

    public function country(){
        return $this->belongsTo(WorldCountry::class, 'country_id', 'id');
    }

    public function division(){
        return $this->belongsTo(WorldDivision::class, 'division_id', 'id');
    }
    public function student_permanent(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'permanent_city_id', 'id');
    }
    public function student_current(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'current_city_id', 'id');
    }
}
