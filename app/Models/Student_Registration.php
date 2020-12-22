<?php

namespace App\Models;

use App\Models\Student_Registration\Academic_Year;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Registration extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='student_registrations';

    protected $fillable=[
        'year_id',
        'student_id',
        'deadline'
    ];

    public function year()
    {
        return $this->belongsTo(Academic_Year::class);
    }
}
