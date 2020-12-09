@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#results').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 results">
      <div class="row">

        <div class="card col-12">
          <div class="card-header">
            Name : S A L SAMARAKKODY <br/>
            Registration No : F021479136
          </div>
          <div class="card-body">
            <table class="table table-bordered table-responsive-md">
              <thead class="text-center">
                <tr>
                  <th rowspan="2">Exam</th>
                  <th colspan="2">FIT 103</th>
                  <th colspan="2">FIT 203</th>
                  <th colspan="2">FIT 303</th>
                </tr>
                <tr>
                  <th>E-Test</th>
                  <th>Practical</th>
                  <th>E-Test</th>
                  <th>Practical</th>
                  <th>E-Test</th>
                  <th>Practical</th>
                </tr>
              </thead>
              <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
