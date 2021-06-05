<?php

namespace App\Models\Exam;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Schedule extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'exam_schedule';

    protected $table='exam_schedules';

    protected $fillable = [
      'subject_id',
      'exam_type_id',
      'date',
      'start_time',
      'end_time',
      'schedule_approval'
    ];

    public function exam(){
      /**
       * The attributes that are assignable.
       *
       * connecting model , foreign_key , local_key
       */
      return $this->belongsTo(Exam::class,'exam_id','id');
  }

    public function type(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Types::class,'exam_type_id','id');
    }
    
    public function subject(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function tempResult(){
      /**
       * The attributes that are assignable.
       *
       * connecting model , foreign_key , local_key
       */
      return $this->hasMany(TempResult::class, 'exam_id', 'exam_id');
  }
}
