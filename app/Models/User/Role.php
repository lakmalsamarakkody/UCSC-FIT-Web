<?php

namespace App\Models\User;

use App\Models\User;
use App\Models\User\Role\Role_Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function user()
    {
        /**
         * The attributes that are assignable.
         *
         * connecting model , foreign_key , local_key
         */
        return $this->hasMany(User::class,'role_id', 'id');
    }

    public function Role_Permission()
    {
        return $this->hasMany(Role_Permission::class,'role_id', 'id');
    }
}
