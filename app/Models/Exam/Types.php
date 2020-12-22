<?php

namespace App\Models\Exam;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Types extends Model
{
    protected $table='exam_types';
    
    use SoftDeletes;
    use HasFactory;
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
