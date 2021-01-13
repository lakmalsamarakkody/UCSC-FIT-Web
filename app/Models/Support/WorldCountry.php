<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class WorldCountry extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table='world_countries';

    public function division()
    {
        return $this->hasMany(WorldDivision::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->hasMany(WorldCity::class, 'country_id', 'id');
    }
    public function student_permanent(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'permanent_country_id', 'id');
    }
    public function student_current(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'current_country_id', 'id');
    }
}
