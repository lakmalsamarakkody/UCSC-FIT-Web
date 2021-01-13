<?php

namespace App\Models\Student;

use App\Models\Exam\Schedule;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class hasExam extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'student_exam';

    protected $table='student_exams';

    public function student(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Student::class,'student_id','id');
    }
    public function schedule(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Schedule::class,'exam_schedule_id','id');
    }
}
