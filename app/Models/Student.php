<?php

namespace App\Models;

use App\Models\Student\Flag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    
    public function flag(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Flag::class,'student_id','id');
    }

    public function payment(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Payment::class,'student_id','id');
    }
    public function exam()
    {
        return $this->hasMany(Student_Exam::class);
    }
}
