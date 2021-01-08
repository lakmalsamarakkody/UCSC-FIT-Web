<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'banks';

    public function branch(){
        return $this->hasMany(BankBranch::class, 'bank_id', 'id');
    }
}
