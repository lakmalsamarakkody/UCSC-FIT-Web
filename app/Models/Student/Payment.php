<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Student\Payment\Method;
use App\Models\Student\Payment\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(Type::class, 'id', 'type_id');
    }

    public function Method()
    {
        return $this->belongsTo(Method::class,'id','method_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id', 'student_id');
    }
}
