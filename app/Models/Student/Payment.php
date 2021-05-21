<?php

namespace App\Models\Student;

use App\Models\Student;
use App\Models\Student\Payment\Method;
use App\Models\Student\Payment\Type;
use App\Models\Support\Bank;
use App\Models\Support\BankBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'payment';

    protected $fillable = [ 'method_id', 'type_id', 'amount', 'bank_id', 'bank_branch_id', 'paid_date', 'image', 'status',];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function method()
    {
        return $this->belongsTo(Method::class,'method_id','id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function bankBranch()
    {
        return $this->belongsTo(BankBranch::class, 'bank_branch_id', 'id');
    }

    public function registration(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Registration::class,'payment_id','id');
    }
}
