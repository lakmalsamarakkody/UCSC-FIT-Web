<?php

namespace App\Models;

use App\Models\Exam\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempResult extends Model
{
    use HasFactory;
    protected $table='temp_results';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
