@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#information').addClass("active");
    });

</script>
@if($student->reg_no == NULL)
        {{-- REGISTRATION  PENDING --}}
        <div class="col-12 px-0">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"><i class="far fa-check-circle"></i> Complete Your Registration! </h4>
                <p>Complete your registration to continue FIT. If your having any issues with the registration, please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
                <hr>
                <a href="" class="px-0 btn btn-link ">Click here to Complete Registration</a>
            </div>
        </div>
        {{-- /REGISTRATION PENDING --}}
@endif
    @if( $student != NULL )

    <!-- CONTENT -->
    <div class="col-lg-12 information">
        <div class="row">
            <div class="col-12">        
                <div class="card">
                    <div class="card-header">
                        Personal Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <table class="table">
                                    <tr>
                                        <th>Registration Number:</th>
                                        <td>{{ $student->reg_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title:</th>
                                        <td>{{ $student->title }}.</td>
                                    </tr>
                                    <tr>
                                        <th>First Name:</th>
                                        <td>{{ $student->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Middle Names:</th>
                                        <td>{{ $student->middle_names }}</td>
                                    </tr>
                                    <tr>
                                        <th>Full Name:</th>
                                        <td>{{ $student->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name with Initials:</th>
                                        <td>{{ $student->initials }} {{ $student->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender:</th>
                                        <td>@if($student->gender == 'Male')<i class="fa fa-lg fa-male"></i>@elseif($student->gender == 'Female')<i class="fa fa-lg fa-female"></i>@endif</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth:</th>
                                        <td>{{ $student->dob }}</td>
                                    </tr>
                                    <tr>
                                        <th>Citizenship:</th>
                                        <td>{{ $student->citizenship }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIC/ Postal/ Passport No:</th>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4 order-md-2 order-1 mb-3 align-middle">  
                                <div class="row">                               
                                    <div class="img mt-5 mb-2 text-center position-relative">
                                        <button class="btn btn-outline-warning position-absolute m-3" data-tooltip="tooltip" data-placement="bottom" title="Change Profile Picture"><i class="fa fa-edit"></i></button>
                                        <img src="{{ asset('img/portal/avatar') }}/{{ Auth::user()->id }}.png" alt="Avatar" class="avatar" width="60%" onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
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
                <div class="card mt-3">
                    <div class="card-header">
                        Education Qualifications
                        <button class="btn btn-outline-warning float-right" data-tooltip="tooltip" data-placement="bottom" title="Edit Details"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table">
                                    <tr>
                                        <th>Highest Qualification</th>
                                        <td>@if($student->education == 'degree')<p>Bachelor's Degree</p>
                                        @elseif($student->education == 'higherdiploma')<p>Advanced/Higher Diploma from a nationally or internationally recognized organisation</p>
                                        @elseif($student->education == 'diploma')<p>Diploma from a nationally or internationally recognized organisation</p>
                                        @elseif($student->education == 'advancedlevel')<p>GCE Advanced Level</p>
                                        @elseif($student->education == 'ordinarylevel')<p>GCE Ordinary Level</p>
                                        @elseif($student->education == 'otherqualification')<p>Any other qualification</p>@endif</td>           
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 contact">
                    <div class="card-header ">
                        Contact Details
                        <button class="btn btn-outline-warning float-right" data-tooltip="tooltip" data-placement="bottom" title="Edit Details"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="card-body">     
                        <div class="row">                                               
                            <div class="col-12 col-md-6">
                                <h5>Permanent Address</h5>
                                <hr>
                                <div class="ml-lg-4">
                                   <p>{{ $student->permanent_house }}</p>  
                                   <p>{{ $student->permanent_address_line1 }}</p>
                                   <p>{{ $student->permanent_address_line2 }}</p>  
                                   <p>{{ $student->permanent_address_line3 }}</p>  
                                   <p>{{ $student->permanent_address_line4 }}</p>
                                   <p>City </p> 
                                   <p>Country</p> 
                                </div>
                            </div>                    
                            <div class="col-12 col-md-6">
                                <h5>Current Address</h5>
                                <hr>
                                <div class="ml-lg-4">
                                   <p>{{ $student->current_house }}</p>  
                                   <p>{{ $student->current_address_line1 }}</p>
                                   <p>{{ $student->current_address_line2 }}</p>  
                                   <p>{{ $student->current_address_line3 }}</p>  
                                   <p>{{ $student->current_address_line4 }}</p>
                                   <p>City</p>
                                   <p>Country</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Telephone No.</th>
                                        <td>+{{ $student->telephone_country_code }} {{ $student->telephone }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>Email</th>
                                        <td>johndoe@gmail.com</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        Employment Details
                        <button class="btn btn-outline-warning float-right" data-tooltip="tooltip" data-placement="bottom" title="Edit Details"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table">
                                    <tr>
                                        <th>Designation</th>
                                        <td>{{ $student->designation }}</td>                                        
                                    </tr>
                                </table>
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
                            <form action="">
                                <div class="form-row">     
                                  <div class="form-group col-12 col-md-3">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control form-control-sm" id="currentPassword" name="currentPassword"/>
                                    <small id="InputCurrentPasswordHelp" class="form-text text-muted">Enter Current Password</small>
                                  </div> 
                                  <div class="form-group col-12 col-md-3">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword"/>
                                    <small id="InputNewPasswordHelp" class="form-text text-muted">Enter New Password</small>
                                  </div> 
                                  <div class="form-group col-12 col-md-3">
                                    <label for="reNewPassword">Re-Type Password</label>
                                    <input type="password" class="form-control form-control-sm" id="reNewPassword" name="reNewPassword"/>
                                    <small id="InputReNewPasswordHelp" class="form-text text-muted">Re-Type New Password</small>
                                  </div>
                                </div>
                                <div class=" text-right w-100">
                                    <button class="btn btn-secondary">Discard</button>
                                    <button class="btn btn-outline-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /CONTENT -->
    @endif

    @include('portal.student.home.scripts')

@endsection



