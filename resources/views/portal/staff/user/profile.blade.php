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
              <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
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
                Student Details
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
                            <td>{{ $user->first_name }}</td>
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
                        <tr>
                            <th>Deativated/ Reactivated Reason:</th>
                            <td>{{ $user->message }}</td>
                        </tr>
                    </table>

                  </div>
                  <div class="col-md-4 align-middle">  
                      <div class="row mb-5 justify-content-center">                               
                          <div class="img mt-0 mb-2  position-relative">
                              <img src="{{ asset('storage/portal/avatar/'.$user->id.'/'.$user->profile_pic)}}" alt="Avatar" class="avatar" width="250px"  onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
                          </div>
                          <div class="text-center w-100 ">
                            <button onclick="reset_email()" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Reset Email">
                              <i class="fa fa-envelope"></i>
                            </button>
                            @if($user->status==1)
                            <button onclick="deactivate_acc()" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Deactivate Account">
                              <i class="fa fa-user-alt-slash"></i>
                            </button>
                            @else                     
                            <button onclick="activate_acc()" class="btn btn-outline-success" data-tooltip="tooltip" data-placement="bottom" title="Activate Account">
                              <i class="fa fa-user-alt"></i>
                            </button>                           
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
