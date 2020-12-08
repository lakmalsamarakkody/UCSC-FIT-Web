<?php

namespace App\Models\Student_Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result_Month extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table='result_months';

    public function user()
    {
        return $this->belongsTo('App\Models\Student_Exam');
    }
}
