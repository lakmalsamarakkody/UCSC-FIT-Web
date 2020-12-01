<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Registration extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='student_registrations';

    protected $fillable=[
        'year_id',
        'student_id',
        'deadline'
    ];

    public function year(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Student_Registration\Academic_Year','id','year_id');
    }
}
