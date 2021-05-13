<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempStudent extends Model
{
    use HasFactory;
    protected $table='temp_students';

    protected $fillable = [
        'reg_no',
        'full_name',
        'unique_id',
        'telephone',
        'email',
        'designation'
    ];
}
