<?php

namespace App\Models\Student\Payment;

use App\Models\Student\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Type extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'payment_type';

    protected $table = 'payment_types';

    public function payment()
    {
        return $this->hasMany(Payment::class, 'type_id', 'id');
    }
}
