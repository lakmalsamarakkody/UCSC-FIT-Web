<?php

namespace App\Models;

use App\Models\Exam\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Exam extends Model
{
  use HasFactory;
  use SoftDeletes;
  use LogsActivity;

  protected static $logAttributes = ['*'];

  protected $table='exams';

  public function schedule(){        
    return $this->hasMany(Schedule::class, 'exam_id', 'id');
  }
}
