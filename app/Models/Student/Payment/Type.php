<?php

namespace App\Models\Student\Payment;

use App\Models\Student\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
