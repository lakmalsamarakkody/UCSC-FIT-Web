<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Support\Str;

class UsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('staff.auth');
  }

  public function index()
  {
    $roles = Role::all();

    return view('portal/staff/users',compact('roles'));
  }

  public function getUserList(Request $request)
  {
    if ($request->ajax()) {
      $data = User::addSelect(['role_name' => Role::select('name')->whereColumn('role_id', 'roles.id')]);
      if($request->name!=null){
        $data = $data->where('name','like', '%'. $request->name.'%');
      }
      if($request->email!=null){
        $data = $data->where('email','like', '%'. $request->email.'%');
      }      
      if($request->role!=null){
        $data = $data->where('role_id', $request->role);
      }
      if($request->status!=null){
        $data = $data->where('status', $request->status);
      }
      if($request->search!=null){
        $data = $data->where('name','like', '%'. $request->search.'%')
        ->orWhere('email','like', '%'. $request->search.'%');
      }
      $data = $data->get();
      return DataTables::of($data)

      ->addIndexColumn()
      ->addColumn('action', function($row){
          $actionBtn = '<a onclick="view_user();" title="View Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>';
          return $actionBtn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }
  }

  public function viewUser()
  {
    return view('portal/staff/user/profile');
  }
}
