<?php

namespace App\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlDistrict extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sl_districts';

    public function province(){
        return $this->belongsTo(SlProvince::class, 'province_id', 'id');
    }

    public function city(){
        return $this->hasMany(SlCity::class, 'district_id', 'id');
    }

    public function bankbranch(){
        return $this->hasMany(BankBranch::class,'district_id', 'id');
    }
    public function student_permanent(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'permanent_state_id', 'id');
    }
    public function student_current(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Student::class, 'current_state_id', 'id');
    }
}
