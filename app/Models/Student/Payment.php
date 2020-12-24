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
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function Method()
    {
        return $this->belongsTo(Method::class,'method_id','id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
