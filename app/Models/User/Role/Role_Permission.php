<?php

namespace App\Models\User\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_Permission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function permission()
    {
        return $this->hasOne('App\Models\User\Role\Role_Permission\Permission','id','permission_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\User\Role');
    }

}
