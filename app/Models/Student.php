<?php

namespace App\Models;

use App\Models\Student\Document;
use App\Models\Student\Flag;
use App\Models\Student\hasExam;
use App\Models\Student\Payment;
use App\Models\Student\Registration;
use App\Models\Support\SlCity;
use App\Models\Support\SlDistrict;
use App\Models\Support\WorldCity;
use App\Models\Support\WorldCountry;
use App\Models\Support\WorldDivision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    
    public function flag(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasOne(Flag::class,'student_id','id');
    }

    public function payment(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Payment::class,'student_id','id');
    }

    public function document(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Document::class,'student_id','id');
    }
    
    public function hasExam(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(hasExam::class, 'student_id', 'id');
    }

    public function registration(){
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(Registration::class, 'student_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function current_city_sl()
    {
        return $this->belongsTo(SlCity::class,'current_city_id');
    }

    public function current_district_sl()
    {
        return $this->belongsTo(SlDistrict::class, 'current_state_id');
    }

    public function permanent_city_sl()
    {
        return $this->belongsTo(SlCity::class, 'permanent_city_id');
    }

    public function permanent_district_sl()
    {
        return $this->belongsTo(SlDistrict::class, 'permanent_state_id');
    }

    public function current_city_world()
    {
        return $this->belongsTo(WorldCity::class,'current_city_id');
    }

    public function current_district_world()
    {
        return $this->belongsTo(WorldDivision::class, 'current_state_id');
    }

    public function permanent_city_world()
    {
        return $this->belongsTo(WorldCity::class, 'permanent_city_id');
    }

    public function permanent_district_world()
    {
        return $this->belongsTo(WorldDivision::class, 'permanent_state_id');
    }

    public function current_country()
    {
        return $this->belongsTo(WorldCountry::class, 'current_country_id');
    } 

    public function permanent_country()
    {
        return $this->belongsTo(WorldCountry::class, 'permanent_country_id');
    } 
}
