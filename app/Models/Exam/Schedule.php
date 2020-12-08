<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
      'subject_id',
      'exam_type_id',
      'date',
      'start_time',
      'end_time'
    ];
    public function type(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Exam\Types','id','exam_type_id');
    }
    
    public function subject(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Subject','id','subject_id');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student_Exam');
    }
}
