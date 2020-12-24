<?php

namespace App\Models\User;

use App\Models\User\Role\Role_Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function role_permission()
    {
        return $this->hasMany(Role_Permission::class,'permission_id', 'id');
    }
}
