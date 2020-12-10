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
              <table class="table table-bordered table-responsive-md">
                <thead class="text-center">
                  <tr>
                    <th rowspan="2"></th>
                    <th colspan="2">FIT 103</th>
                    <th colspan="2">FIT 203</th>
                    <th colspan="2">FIT 303</th>
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
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
