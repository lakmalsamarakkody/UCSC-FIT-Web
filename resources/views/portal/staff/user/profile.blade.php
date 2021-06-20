@extends('layouts.profile')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#students').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row justify-content-lg-between">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>

          @if($user->status == 0)
          <div class="alert alert-danger float-right" role="alert">
            <h4>This Account has been Deactivated</h4> 
          </div>
            
          @endif

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 student">
      <div class="row">
        <!-- <div class="col-lg-2"></div> -->

        <div class="col-lg-12">

            <div class="card   ">
              <div class="card-header">
                User Details
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-8">
                    <table class="table">
                      <tr>
                          <th>User ID:</th>
                          <td>{{ $user->id }}</td>
                      </tr>
                      <tr>
                          <th>User Name:</th>
                          <td>{{ $user->name }}</td>
                      </tr>
                      <tr>
                        <th>User Role:</th>
                        <td><h5><span class="badge badge-warning"> {{ $user->role->name }} </span></h5></td>
                      </tr>
                      <tr>
                          <th>Email:</th>
                          <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                          <th>Status:</th>
                          <td>                            
                          @if($user->status==1)
                          <h4><span class="badge badge-success">Active</span></h4>
                          @else                     
                          <h4><span class="badge badge-danger">Deactive</span></h4>                           
                          @endif 
                          </td>
                      </tr>
                      @if(Auth::user()->hasPermission('staff-user-profile-chnageUserRole'))
                      <tr id="trChnageUserRole" class="d-none">
                        <th>User Role:</th>
                        <td>
                          <form class="form-inline">
                            <div class="form-group">
                              <select class="form-control" name="changeUserRole" id="changeUserRole">
                                <option value="" hidden>Select Role</option>
                                @foreach($roles as $role)
                                  @if($role->id == $user->role->id)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                  @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                            <button onclick="change_userRole()" class="btn btn-outline-primary ml-2" >update <span id="spinnerUpdateRole" class="spinner-border spinner-border-sm d-none"></span></button>
                          </form>
                        </td>
                      </tr>
                      @endif
                      @if($user->message)
                      <tr>
                          <th>Deativated/ Reactivated Reason:</th>
                          <td>{{ $user->message }}</td>
                      </tr>
                      @endif
                    </table>
                  </div>
                  <div class="col-md-4 align-middle">  
                      <div class="row mb-5 justify-content-center">                               
                          <div class="img mt-0 mb-2  position-relative">
                              <img src="{{ asset('storage/portal/avatar/'.$user->id.'/'.$user->profile_pic)}}" alt="Avatar" class="avatar" width="250px"  onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
                          </div>
                          <div class="text-center w-100 ">
                            @if(Auth::user()->hasPermission('staff-user-profile-chnageUserRole'))
                            <button class="btn btn-outline-primary" onclick="makeEditableRole()" data-tooltip="tooltip" data-placement="bottom" title="Change Role" data-toggle="collapse" data-target="#collapseChangeRole" aria-expanded="false" aria-controls="collapseChangeRole">
                              <i class="fa fa-user-shield"></i>
                            </button>
                            @endif
                            @if(Auth::user()->hasPermission('staff-user-profile-resetEmail'))
                            <button onclick="reset_email()" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Reset Email">
                              <i class="fa fa-envelope"></i>
                            </button>
                            @endif
                            @if($user->status==1)
                              @if(Auth::user()->hasPermission('staff-user-profile-deactivate'))
                              <button onclick="deactivate_acc()" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Deactivate Account">
                                <i class="fa fa-user-slash"></i>
                              </button>
                              @endif
                            @else   
                              @if(Auth::user()->hasPermission('staff-user-profile-activate'))                  
                              <button onclick="activate_acc()" class="btn btn-outline-success" data-tooltip="tooltip" data-placement="bottom" title="Activate Account">
                                <i class="fa fa-user-check"></i>
                              </button>
                              @endif
                            @endif     
                          </div>                          
                      </div>   
                  </div>  
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
    <!-- /CONTENT -->
<div class="mb-5">&nbsp;</div>

 @include('portal.staff.user.profile.scripts')

@endsection
