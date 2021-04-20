<?php

namespace App\Models\Student;

use App\Models\Exam\Schedule;
use App\Models\Student;
use App\Models\Exam\Types;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Student\Medical;
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

    protected $fillable = [
        'student_id',
        'exam_schedule_id',
        'subject_id',
        'exam_type_id',
        'requested_exam_id',
        'schedule_status',
        'payment_id',
        'payment_status',
        'declined_message',
        'medical_status',
        'medical_id',
        'schedule_status',
        'exam_reschedule_id'
    ];

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

    public function subject() {
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function type() {
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Types::class, 'exam_type_id', 'id');
    }

    public function exam() {
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Exam::class, 'requested_exam_id', 'id');
    }

    public function medical() {
        return $this->belongsTo(Medical::class, 'medical_id', 'id');
    }
}
