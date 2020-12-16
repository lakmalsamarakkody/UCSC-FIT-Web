@extends('layouts.student_portal')

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
                <div class="card mt-3" id="account">
                    <div class="card-header">
                        Account Settings
                    </div>
                    <div class="card-body">                        
                        <div class="col-12">
                            <form action="">
                                <div class="form-row">     
                                  <div class="form-group col-12 col-md-4">
                                    <label for="currentPassword">User Name</label>
                                    <input type="text" class="form-control form-control-sm" id="currentPassword" name="currentPassword"/>
                                    <small id="InputCurrentPasswordHelp" class="form-text text-muted">Enter Username</small>
                                  </div> 
                                  <div class="form-group col-12 col-md-4">
                                    <label for="newPassword">Password</label>
                                    <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword"/>
                                    <small id="InputNewPasswordHelp" class="form-text text-muted">Enter Password</small>
                                  </div> 
                                  <div class="form-group col-12 col-md-4">
                                    <label for="reNewPassword">Re-Type Password</label>
                                    <input type="password" class="form-control form-control-sm" id="reNewPassword" name="reNewPassword"/>
                                    <small id="InputReNewPasswordHelp" class="form-text text-muted">Re-Type Password</small>
                                  </div>
                                </div>
                                <div class=" text-right w-100">
                                    <button class="btn btn-secondary">Discard</button>
                                    <button class="btn btn-outline-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTENT -->
    @include('portal.student.guest.scripts')
@endsection



