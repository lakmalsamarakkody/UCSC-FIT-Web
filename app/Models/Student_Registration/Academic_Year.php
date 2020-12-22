<?php

namespace App\Models\Student_Registration;

use App\Models\Student_Registration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Academic_Year extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='academic_years';

    protected $fillable = [
        'year',
        'start',
        'end'
    ];

    public function student_registration()
    {
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Student_Registration::class,'id','year_id');
    }
}
