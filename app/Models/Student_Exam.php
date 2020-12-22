<?php

namespace App\Models;

use App\Models\Exam\Schedule;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Exam extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='student_exams';

    public function student(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Student::class,'id','student_id');
    }
    public function exam(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Schedule::class,'id','exam_schedule_id');
    }
}
