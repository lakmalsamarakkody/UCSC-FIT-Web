<?php

namespace App\Models\Exam;

use App\Models\Exam;
use App\Models\Student\Payment\Type;
use App\Models\Student_Exam;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='exam_schedules';

    protected $fillable = [
      'subject_id',
      'exam_type_id',
      'date',
      'start_time',
      'end_time'
    ];

    public function exam(){
      /**
       * The attributes that are assignable.
       *
       * connecting model , foreign_key , local_key
       */
      return $this->hasOne(Exam::class,'id','exam_id');
  }

    public function type(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Type::class,'id','exam_type_id');
    }
    
    public function subject(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Subject::class,'id','subject_id');
    }
    public function student()
    {
        return $this->belongsTo(Student_Exam::class);
    }
}
