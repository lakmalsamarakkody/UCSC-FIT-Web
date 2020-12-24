<?php

namespace App\Models;

use App\Models\Exam\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table='exams';

  public function schedule(){        
    return $this->hasMany(Schedule::class, 'exam_id', 'id');
  }
}
