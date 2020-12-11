<?php

namespace App\Http\Controllers\Portal\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\User\Role;

class UsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('revalidate');
  }

  public function index()
  {
    return view('portal/staff/users');
  }

  public function getUserList(Request $request)
  {
    if ($request->ajax()) {
      $data = User::addSelect(['role_name' => Role::select('name')->whereColumn('role_id', 'roles.id')])->get();
      
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
