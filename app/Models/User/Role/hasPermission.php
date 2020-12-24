<?php

namespace App\Models\User\Role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hasPermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function permission()
    {
        return $this->belongsTo(Permission::class,'id','permission_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id', 'role_id');
    }
}
