<?php

namespace App\Models\Student_Registration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Academic_Year extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table='academic_years';

    protected $fillable = [
        'year',
        'start',
        'end'
    ];

    public function student_registration()
    {
        return $this->belongsTo('App\Models\Student_Registration');
    }
}
