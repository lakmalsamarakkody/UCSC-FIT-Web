<?php

namespace App\Models;

use App\Models\Exam\Duration;
use App\Models\Exam\Schedule;
use App\Models\Support\Fee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Subject extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'subject';

    protected $fillable = [
        'code',
        'name'
    ];

    public function schedule(){
        return $this->hasMany(Schedule::class, 'subject_id', 'id');
    }

    public function tempResult(){
        return $this->hasMany(TempResult::class, 'subject_id', 'id');
    }

    public function fee(){
        return $this->hasMany(Fee::class, 'subject_id', 'id');
    }

    public function duration()
    {
        return $this->hasMany(Duration::class, 'subject_id', 'id');
    }
}
