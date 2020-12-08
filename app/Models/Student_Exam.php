<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_Exam extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function role(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne('App\Models\Student_Exam\Result_Month','id','result_id');
    }
}
