<?php

namespace App\Models\User\Role;

use App\Models\User\Role;
use App\Models\User\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_Permission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function permission()
    {
        return $this->belongsTo(Permission::class,'id','permission_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }

}
