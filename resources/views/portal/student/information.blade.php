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
    <div id="alertCompleteRegistration" class="col-12 px-0">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Complete Your Registration! </h4>
            <p>Complete your registration to continue FIT. If your having any issues with the registration, please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
            <hr>
            <a href="{{ route('student.registration') }}" class="px-0 btn btn-link ">Click here to Complete Registration</a>
        </div>
    </div>
    {{-- /REGISTRATION PENDING --}}
    @endif

    @if( $student != NULL )
    <div class="col-12">
        <div class="row justify-content-end">
            <div class="col-lg-4">
                <button class="btn btn-lg mb-3 btn-danger w-100" onclick="print_window()"><i class="fa fa-print"></i> Download Application</button>
            </div>
        </div>
    </div>
    <div class="col-12 mt-5 d-none heading">
        <div class="row">
            <div class="col-2"><img src="{{ asset('img/logo/ucsc.png') }}" class="img-fluid" width="37%"></div>
            <div class="col-8">
                <h5 class="text-center font-weight-bold">
                    Application for Foundation of Information Technology <br>
                    <small>University of Colombo School of Computing</small> 
                </h5>
            </div>
            <div class="col-2 text-right align-middle"><img src="{{ asset('img/logo/fit-nav.png') }}" class="img-fluid" width="50%"> </div>
        </div>
    </div>
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
                                        <td>@if($student->gender == 'Male')<i class="fa fa-lg fa-male"></i> Male @elseif($student->gender == 'Female')<i class="fa fa-lg fa-female"></i>Female @endif</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth:</th>
                                        <td>{{ $student->dob }}</td>
                                    </tr>
                                    <tr>
                                        <th>Citizenship:</th>
                                        <td>{{ $student->citizenship }}</td>
                                    </tr>
                                    @if($student->nic_old)                                        
                                    <tr>
                                        <th>NIC (old):</th>
                                        <td>{{ $student->nic_old }}</td>
                                    </tr>
                                    @endif
                                    @if($student->nic_new)                                     
                                    <tr>
                                        <th>NIC (new):</th>
                                        <td>{{ $student->nic_new }}</td>
                                    </tr>
                                    @endif
                                    @if($student->postal)                                     
                                    <tr>
                                        <th>Postal ID:</th>
                                        <td>{{ $student->postal }}</td>
                                    </tr>
                                    @endif
                                    @if($student->passport)                                     
                                    <tr>
                                        <th>Passport No:</th>
                                        <td>{{ $student->passport }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-4 order-md-2 order-1 mb-3 align-middle">  
                                <div class="row  justify-content-center">                               
                                    <div class="img mt-5 mb-2  position-relative">
                                        <button class="btn btn-outline-warning position-absolute m-3" data-tooltip="tooltip" data-placement="bottom" title="Change Profile Picture" data-toggle="modal" data-target="#modal-profile-picture"><i class="fa fa-edit"></i></button>
                                        <img src="{{ asset('storage/portal/avatar/'.$student->user_id.'/'.$student->user->profile_pic)}}" alt="Avatar" class="avatar" width="250px"  onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
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
                        <button class="btn btn-outline-warning float-right" data-tooltip="tooltip" data-placement="bottom" title="Edit Details" data-toggle="modal" data-target="#modal-education-qualification"><i class="fa fa-edit"></i></button>
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
                        <button class="btn btn-outline-warning float-right" data-tooltip="tooltip" data-placement="bottom" title="Edit Details" data-toggle="modal" data-target="#modal-contact-details"><i class="fa fa-edit"></i></button>
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
                                   @if( $student->permanent_country_id == 67 )                                         
                                    <p>{{ $student->permanent_city_sl->name ?? ''}}</p>                                       
                                    <p>{{ $student->permanent_district_sl->name ?? ''}}</p>
                                    <p>{{ $student->permanent_country->name ?? ''}}</p>
                                   @else                                    
                                    <p>{{ $student->permanent_city_world->name ?? ''}}</p>
                                    <p>{{ $student->permanent_district_world->name ?? ''}}</p>
                                    <p>{{ $student->permanent_country->name ?? ''}}</p>
                                   @endif
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
                                   @if( $student->current_country_id == 67 )                                         
                                    <p>{{ $student->current_city_sl->name ?? ''}}</p>                                       
                                    <p>{{ $student->current_district_sl->name ?? ''}}</p>
                                    <p>{{ $student->current_country->name ?? ''}}</p>
                                   @else                                    
                                    <p>{{ $student->current_city_world->name ?? ''}}</p>
                                    <p>{{ $student->current_district_world->name ?? ''}}</p>
                                    <p>{{ $student->current_country->name ?? ''}}</p>
                                   @endif
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
                                        <td>{{ $student->user->email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if($student->designation != NULL)
                <div class="card mt-3">
                    <div class="card-header">
                        Employment Details
                        <button class="btn btn-outline-warning float-right" data-tooltip="tooltip" data-placement="bottom" title="Edit Details" data-toggle="modal" data-target="#modal-employment-details"><i class="fa fa-edit"></i></button>
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
                @endif

                <hr id="hrSettings" class="my-5">
                <p id="applicationGeneratorFooter" class="d-none">This is a system generated application. ({{ now() }})</p>
                <div class="card" id="account">
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
                                    <span class="invalid-feedback" id="error-currentPassword" role="alert"></span>
                                    <small id="InputCurrentPasswordHelp" class="form-text text-muted">Enter Current Password</small>
                                  </div> 
                                  <div class="form-group col-lg col-12">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control form-control-sm" id="newPassword" name="newPassword"/>
                                    <span class="invalid-feedback" id="error-newPassword" role="alert"></span>
                                    <small id="InputNewPasswordHelp" class="form-text text-muted">Enter New Password</small>
                                  </div> 
                                  <div class="form-group col-lg col-12">
                                    <label for="reNewPassword">Re-Type Password</label>
                                    <input type="password" class="form-control form-control-sm" id="reNewPassword" name="reNewPassword"/>
                                    <span class="invalid-feedback" id="error-reNewPassword" role="alert"></span>
                                    <small id="InputReNewPasswordHelp" class="form-text text-muted">Re-Type New Password</small>
                                  </div>
                                </div>
                            </form>
                                <div class=" text-right w-100">
                                    <button class="btn btn-secondary" onclick="window.location.reload();">Discard</button>
                                    <button id="btnChangePassword" class="btn btn-outline-primary" onclick="update_password()">
                                    Change Password
                                    <span id="spinnerPassword" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('portal.student.information.modal')
        </div>
    </div>
    <!-- /CONTENT -->
    @endif

    @include('portal.student.information.scripts')

@endsection



