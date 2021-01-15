@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#information').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 information">
        <div class="row">
            <div class="col-12">        
                <div class="card">
                    <div class="card-header">
                        User Details                    
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <table class="table">
                                    <tr>
                                        <th>User ID:</th>
                                        <td>{{ Auth::user()->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>User Name:</th>
                                        <td>{{ Auth::user()->name }}.</td>
                                    </tr>
                                    <tr>
                                        <th>User Email:</th>
                                        <td>{{ Auth::user()->email }}.</td>
                                    </tr>
                                    <tr>
                                        <th>User Role:</th>
                                        <td>{{ Auth::user()->role->name }}.</td>
                                    </tr>
                                    <tr>
                                        <th>User Created at:</th>
                                        <td>{{ Auth::user()->created_at }}.</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 order-md-2 order-1 mb-3 align-middle">  
                                <div class="row  justify-content-center">                               
                                    <div class="img mt-1 mb-2  position-relative">
                                        <button class="btn btn-outline-warning position-absolute m-3" data-tooltip="tooltip" data-placement="bottom" title="Change Profile Picture" data-toggle="modal" data-target="#modal-profile-picture"><i class="fa fa-edit"></i></button>
                                        <img src="{{ asset('storage/portal/avatar/'.Auth::user()->id.'/'.Auth::user()->profile_pic)}}" alt="Avatar" class="avatar" width="250px"  onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
                                    </div>
                                    <div class="text-center w-100 ">
                                        <a href="#account" class="btn btn-outline-primary" data-tooltip="tooltip" data-placement="bottom" title="Change Password">
                                            <i class="fa fa-key"></i>
                                        </a>
                                        <button onclick="reset_email()" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Change Email">
                                            <i class="fa fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="card mt-3" id="account">
                    <div class="card-header">
                        Account Settings
                    </div>
                    <div class="card-body">                        
                        <div class="col-12">
                            <form id="changePassword">
                                <div class="form-row">     
                                  <div class="form-group col-lg col-12">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control form-control-sm" id="currentPassword" name="currentPassword"/>
                                    <small id="InputCurrentPasswordHelp" class="form-text text-muted">Enter Current Password</small>
                                  </div> 
                                  <div class="form-group col-lg col-12">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword"/>
                                    <small id="InputNewPasswordHelp" class="form-text text-muted">Enter New Password</small>
                                  </div> 
                                  <div class="form-group col-lg col-12">
                                    <label for="reNewPassword">Re-Type Password</label>
                                    <input type="password" class="form-control form-control-sm" id="reNewPassword" name="reNewPassword"/>
                                    <small id="InputReNewPasswordHelp" class="form-text text-muted">Re-Type New Password</small>
                                  </div>
                                </div>
                            </form>
                                <div class=" text-right w-100">
                                    <button class="btn btn-secondary" onclick="reset_form()">Discard</button>
                                    <button class="btn btn-outline-primary" onclick="update_account()">Change Password</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('portal.staff.information.modal')
        </div>
    </div>
    <!-- /CONTENT -->

    @include('portal.staff.information.scripts')

@endsection



