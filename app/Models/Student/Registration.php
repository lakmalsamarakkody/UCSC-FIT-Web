<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='student_registrations';

    protected $fillable=[
        'year_id',
        'student_id',
        'deadline'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id', 'student_id');
    }
}
