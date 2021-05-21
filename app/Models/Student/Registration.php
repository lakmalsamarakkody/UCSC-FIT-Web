<?php

namespace App\Models\Student;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'student_registration';

    protected $table='student_registrations';
    protected $fillable = ['student_id', 'registered_at', 'registration_expire_at', 'application_submit', 'application_status', 'document_submit', 'document_status', 'payment_id', 'payment_status', 'status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function flag(){
        return $this->hasOne(Flag::class,'student_id','student_id');
    }
}
