<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Student\hasExam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Medical extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'medicals';

    protected $table = 'medicals';

    protected $fillable = [
        'status',
        'declined_message',
    ];

    public function student_exam() {
        return $this->hasMany(hasExam::class, 'student_exam_id', 'id');
    }

}
