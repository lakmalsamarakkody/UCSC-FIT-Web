<?php

namespace App\Models\Support;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class SlCity extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table = 'sl_cities';

    public function district(){
        return $this->belongsTo(SlDistrict::class, 'district_id', 'id');
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
