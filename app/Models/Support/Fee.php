<?php

namespace App\Models\Support;

use App\Models\Exam\Types;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fees';

    public function examType(){
        return $this->belongsTo(Types::class, 'exam_type_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');    
    }
}
