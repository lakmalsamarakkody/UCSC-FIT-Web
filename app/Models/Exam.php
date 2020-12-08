<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table='exams';

  public function student_exam(){        
    return $this->belongsTo('App\Models\Student_Exam');
  }

  public function exam_schedule(){        
    return $this->belongsTo('App\Models\Exam\Schedule');
  }
}
