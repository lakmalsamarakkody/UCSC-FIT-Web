<?php

namespace App\Models;

use App\Models\Exam\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'code',
        'name'
    ];
    
    public function schedule(){        
        return $this->hasMany(Schedule::class, 'subject_id', 'id');
    }

}
