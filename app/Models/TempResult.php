<?php

namespace App\Models;

use App\Models\Exam\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempResult extends Model
{
    use HasFactory;
    protected $table='temp_results';

    protected $fillable = [
        'exam_schedule_id',
        'student_reg_no',
        'grade'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_reg_no','reg_no');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class,'exam_schedule_id','id');
    }
}
