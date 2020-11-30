<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'subject',
        'exam_type'
    ];
}
