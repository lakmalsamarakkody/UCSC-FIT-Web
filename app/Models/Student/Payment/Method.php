<?php

namespace App\Models\Student\Payment;

use App\Models\Student\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Method extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'payment_methods';

    public function payment()
    {
        return $this->hasMany(Payment::class, 'method_id', 'id');
    }
}
