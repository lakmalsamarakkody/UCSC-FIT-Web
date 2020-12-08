<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Exam extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='student_exams';

    public function month(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Student_Exam\Result_Month','id','result_id');
    }
    public function student(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Student','id','student_id');
    }
    public function exam(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Exam','id','exam_id');
    }
}
