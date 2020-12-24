<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='student_flags';

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
