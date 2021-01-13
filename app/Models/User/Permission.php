<?php

namespace App\Models\User;

use App\Models\User\Role\hasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use SoftDeletes;
    use HasFactory;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'permission_type';

    public function hasPermission()
    {
        return $this->hasMany(hasPermission::class,'permission_id', 'id');
    }
}
