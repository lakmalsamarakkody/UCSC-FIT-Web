@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#results').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 student-results min-vh-100">
      <div class="row">

        <div class="card col-12 mt-4">
          <div class="card-header pt-3">
            Name : S A L SAMARAKKODY <br/>
            Registration No : F021479136
          </div>
          <div class="card-body">
            <div class="card-title">
                <b>BIT Eligibility : </b> <span class="badge badge-success">Eligible</span><br/>
                <b>FIT Certificate : </b> <span class="badge badge-danger">Not Eligible</span></div>
            <div class="card-text">
              <div class="w-100 text-right">N/A - Not Applied | CN - Cancelled | EO - Examination Offence | WH - With Hold | AB - Absent</div>
              {{-- <table class="table table-bordered table-responsive-md">
                <thead class="text-center">
                  <tr>
                    <th scope="col" rowspan="2"></th>
                    <th scope="col" colspan="2">FIT 103</th>
                    <th scope="col" colspan="2">FIT 203</th>
                    <th scope="col" colspan="2">FIT 303</th>
                  </tr>
                  <tr>
                    <th>E-Test</th>
                    <th>Practical</th>
                    <th>E-Test</th>
                    <th>Practical</th>
                    <th colspan="2">E-Test</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-left">2020 August</td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-warning">N/A</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-danger">F</span></td>
                    <td><span class="badge badge-success">P</span></td>
                  </tr>
                  <tr>
                    <td class="text-left">2020 September</td>
                    <td><span class="badge badge-danger">F</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-warning">N/A</span></td>
                  </tr>
                  <tr>
                    <td class="text-left">2020 October</td>
                    <td><span class="badge badge-warning">N/A</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-danger">F</span></td>
                    <td><span class="badge badge-success">P</span></td>
                    <td><span class="badge badge-success">P</span></td>
                  </tr>
                </tbody>
              </table> --}}
            </div>

            <div class="col-lg-12 px-0" id="accordion">
              <div class="card">
                <div class="card-header shadow-sm" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn w-100 text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      2017
                      <i class="fa fa-chevron-right float-right"></i>
                    </button>
                  </h5>
                </div>            
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <div class="card-body">
                      <table class="table w-100 text-center">
                          <thead>
                              <th>Subject</th>
                              <th>Exam Type</th>
                              <th>Result</th>
                              <th>Medical</th>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>FIT103</td>
                                  <td>E Test</td>
                                  <td><h4><span class="badge badge-success">P</span></h4></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td>FIT203</td>
                                  <td>E Test</td>
                                  <td><h4><span class="badge badge-danger">F</span></h4></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td>FIT303</td>
                                  <td>E Test</td>
                                  <td><h4><span class="badge badge-light">N/A</span></h4></td>
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
    <!-- /CONTENT -->

@endsection
@include('portal.student.result.script')