<?php

namespace App\Models\Exam;

use App\Models\Exam;
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
      return $this->belongsTo(Exam::class,'id','exam_id');
  }

    public function type(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Types::class,'id','exam_type_id');
    }
    
    public function subject(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->belongsTo(Subject::class,'id','subject_id');
    }
}
