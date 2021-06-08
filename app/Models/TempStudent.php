<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempStudent extends Model
{
    use HasFactory;
    protected $table='temp_students';

    protected $fillable = ['reg_no','full_name','initials','last_name','title','gender','citizenship','unique_id','dob','permanent_address_line1','permanent_address_line2','permanent_address_line3','city','telephone','email','reg_fee','paid_branch','paid_date','designation'];
}