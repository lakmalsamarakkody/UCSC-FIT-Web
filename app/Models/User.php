<?php

namespace App\Models;

use App\Models\User\Role;
use App\Models\User\Permission;
use App\Models\User\Role\hasPermission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable, HasApiTokens;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logName = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class,'role_id', 'id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    public function hasStudent($userID)
    {
        $student = Student::where('user_id', $userID)->first();
        if($student):
            return $student->id;
        else:
            return FALSE;
        endif;
    }

    // CHECK IF USER HAS SOME PERMISSION
	public function hasPermission($permission) {

		$permission = Permission::where('name', $permission)->first();

		if ( $permission !== NULL ):
			if ( hasPermission::where('role_id', Auth::user()->role->id)->where('permission_id', $permission->id)->first() !== NULL ):
				return true;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
}
