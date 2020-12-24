<?php

namespace App\Models\User;

use App\Models\User\Role\hasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function hasPermission()
    {
        return $this->hasMany(hasPermission::class,'permission_id', 'id');
    }
}
