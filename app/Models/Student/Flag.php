<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Flag extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'student_flag';
    
    protected $table='student_flags';
    protected $fillable = ['student_id', 'info_complete', 'info_editable', 'declaration', 'bit_eligible', 'fit_cert', 'phase_id', 'enrollment'];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function registration(){
        return $this->hasMany(Registration::class,'student_id','student_id');
    }
}
