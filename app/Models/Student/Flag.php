<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Flag extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    
    protected $table='student_flags';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
