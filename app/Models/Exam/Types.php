<?php

namespace App\Models\Exam;

use App\Models\Support\Fee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Types extends Model
{
    protected $table='exam_types';
    
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'exam_type';

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'exam_type_id', 'id');
    }

    public function fee()
    {
        return $this->hasMany(Fee::class, 'exam_type_id', 'id');
    }
}
