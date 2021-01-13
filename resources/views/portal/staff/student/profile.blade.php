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
                              <td>John John</td>
                          </tr>
                          <tr>
                              <th>Email:</th>
                              <td>John@gmail.com</td>
                          </tr>
                          <tr>
                              <th>Telephone No:</th>
                              <td>+94777156654</td>
                          </tr>
                          <tr>
                              <th>Title:</th>
                              <td id="title">Mr.</td>
                          </tr>
                          <tr>
                              <th>Full Name:</th>
                              <td id="first_name">John John John John John John John John Doe</td>
                          </tr>
                          <tr>
                              <th>Name with Initials:</th>
                              <td id="middle_names">J J J J J J J J Doe</td>
                          </tr>
                      </table>

                  </div>
                  <div class="col-lg-4 ">  
                      <div class="row">                               
                          <div class="img my-2 text-center">
                              <img src="{{ asset('img/portal/avatar') }}/{{ Auth::user()->id }}/{{ Auth::user()->profile_pic }}" alt="Avatar" class="avatar" width="60%">
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
