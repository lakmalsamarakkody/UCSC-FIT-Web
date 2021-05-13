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
        return $this->belongsTo(Student::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
