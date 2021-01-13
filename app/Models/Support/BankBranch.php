<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class BankBranch extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table = 'bank_branches';

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }

    public function district(){
        return $this->belongsTo(SlDistrict::class, 'district_id', 'id');
    }

    public function payment(){
        return $this->hasMany(Payment::class, 'bank_branch_id', 'id');
    }
}
