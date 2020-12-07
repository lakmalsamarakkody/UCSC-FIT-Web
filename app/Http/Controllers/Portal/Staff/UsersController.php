<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
      return view('portal/staff/users');
    }

    public function getUserList(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('roles', 'users.role_id', '=', 'roles.id')->select('users.name','users.email','users.status','roles.name as rolename')->get();
            
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<button data-toggle="modal" data-target="#exampleModal" title="View Profile" data-toggle="tooltip" data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
