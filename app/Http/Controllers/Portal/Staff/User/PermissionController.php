<?php

namespace App\Http\Controllers\Portal\Staff\User;

use App\Http\Controllers\Controller;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\Role\hasPermission;
use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\isTrue;

class PermissionController extends Controller
{
    public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('staff.auth');
  }

    public function index(Request $request){
        //GET ROLES
        $roles = Role::get();
        $modules = NULL;
        $portal = NULL;
        $selectedUserRole = NULL;

        if($request->selectUserRole != NULL):
            // SET SELECTED USER ROLE
            $selectedUserRole = $request->selectUserRole;
            // SET PERMISSION PORTAL
            $userRole = Role::where('id', $request->selectUserRole)->first();
            if ($userRole->name == 'Student'):
                $portal = 'student';
            else:
                $portal = 'staff';
            endif;

            //GET PERMISSION MODULES OF RELEVENT PORTAL
            $modules = Permission::select('module')->where('portal', $portal)->groupBy('module')->get();
        endif;
        //RETURN
        $request->flash();
        return view('portal/staff/user/permissions', compact('roles', 'portal', 'modules', 'selectedUserRole'))  ;
    }

    public function permissionStatusChanger(Request $request){
        //SET PERMISSION TO A ROLE
        if($request->permissionStatus == 'true'):
            //CHECK IS EXIST PERMISSION
            if(isNull(hasPermission::where('role_id',$request->roleID)->where('permission_id', $request->permissionID)->first())):
                hasPermission::create([
                    'role_id' => $request->roleID,
                    'permission_id' => $request->permissionID
                ]);
            endif;

        //REMOVE PERMISSION FROM A ROLE
        else:
            //CHECK IS EXIST PERMISSION
            if(hasPermission::where('role_id',$request->roleID)->where('permission_id', $request->permissionID)->first()):
                hasPermission::where('role_id', $request->roleID)->where('permission_id', $request->permissionID)->forceDelete();
            endif;
        endif;
        return response()->json(['status'=>'success']);

    }
}
