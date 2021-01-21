@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#students').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Students</a></li>
              <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
            </ol>
          </nav>

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
                  <div class="col-md-4 align-middle">  
                      <div class="row  justify-content-center">                               
                          <div class="img mt-5 mb-2  position-relative">
                              <img src="{{ asset('storage/portal/avatar/'.$student->user_id.'/'.$student->user->profile_pic)}}" alt="Avatar" class="avatar" width="250px"  onError="this.onerror=null;this.src='{{ asset('img/portal/avatar/default.jpg') }}';">
                          </div>
                          <div class="text-center w-100 ">
                            <button onclick="reset_password()" class="btn btn-outline-primary" data-tooltip="tooltip" data-placement="bottom" title="Reset Password">
                              <i class="fa fa-key"></i>
                            </button>
                            <button onclick="reset_email()" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Reset Email">
                              <i class="fa fa-envelope"></i>
                            </button>
                            <button onclick="activate_acc()" class="btn btn-outline-success" data-tooltip="tooltip" data-placement="bottom" title="Activate Account">
                              <i class="fa fa-user-alt"></i>
                            </button>
                            <button onclick="deactivate_acc()" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Deactivate Account">
                              <i class="fa fa-user-alt-slash"></i>
                            </button>
                          </div>
                      </div>   
                  </div>
                  <div class="col-lg-12">
                      <hr>
                      <div class="row">
                          <div class="col-lg-6">
                              <table class="table table-borderless">                        
                                  <tr>
                                      <th>BIT Eligibility:</th>
                                      <td><h4><span class="badge badge-success">Eligible</span></h4></td>
                                      <th>FIT Certificate:</th>
                                      <td><h4><span class="badge badge-danger">Not Eligible</span></h4></td>
                                  </tr>
                              </table>

                          </div>                       

                      </div>
                      <hr>
                      <div class="row">                        
                          <div class="col-lg-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="result-tab" data-toggle="tab" href="#result" role="tab" aria-controls="result" aria-selected="true">Results</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" id="medicals-tab" data-toggle="tab" href="#medicals" role="tab" aria-controls="medicals" aria-selected="false">Medicals</a>
                              </li>
                            </ul>
                            <div class="tab-content pt-3" id="myTabContent">
                              <div class="tab-pane fade show active" id="result" role="tabpanel" aria-labelledby="results-tab">
                                <table class="table table-bordered table-responsive-md">
                                  <thead class="text-center">
                                    <tr>
                                      <th rowspan="2">Exam</th>
                                      <th colspan="2">FIT 103</th>
                                      <th colspan="2">FIT 203</th>
                                      <th >FIT 303</th>
                                    </tr>
                                    <tr>
                                      <th>E-Test</th>
                                      <th>Practical</th>
                                      <th>E-Test</th>
                                      <th>Practical</th>
                                      <th>E-Test</th>
                                    </tr>
                                  </thead>
                                  <tbody class="text-center">
                                    <tr>
                                      <td>2017 June</td>
                                      <td>56</td>
                                      <td>80</td>
                                      <td>65</td>
                                      <td>60</td>
                                      <td>45</td>
                                    </tr>
                                    <tr>
                                      <td>2017 June</td>
                                      <td>56</td>
                                      <td>80</td>
                                      <td>65</td>
                                      <td>60</td>
                                      <td>45</td>
                                    </tr>
                                    <tr>
                                      <td>2017 June</td>
                                      <td>56</td>
                                      <td>80</td>
                                      <td>65</td>
                                      <td>60</td>
                                      <td>45</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="tab-pane fade" id="medicals" role="tabpanel" aria-labelledby="medicals-tab">
                                <table class="table table-bordered table-responsive-md">
                                  <thead class="text-center">
                                    <tr>
                                      <th>Exam</th>
                                      <th>Subject</th>
                                      <th>Exam Type</th>
                                      <th>Medical</th>
                                    </tr>
                                  </thead>
                                  <tbody class="text-center">
                                    <tr>
                                      <td>2017 June</td>
                                      <td>FIT 203</td>
                                      <td>Practical</td>
                                      <td><button class="btn btn-sm btn-warning px-32 text-center"><i class="fa fa-eye p-0"></i></button></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
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

 @include('portal.staff.student.profile.scripts')

@endsection
