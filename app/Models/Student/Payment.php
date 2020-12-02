<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function type()
    {
        return $this->hasOne('App\Models\Student\Payment\Type', 'id', 'type_id');
    }

    public function Method()
    {
        return $this->hasOne('App\Models\Student\Payment\Method','id','method_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
