@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#dashboard').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Exam Applications</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 exam-application">
      <div class="row">
          
        <!-- APPLICATIONS LIST -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Exam Applicants</div>
            <div class="card-body">
              <table class="table yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th>Registration No</th>
                    <th>Student Name</th>
                    <th>Date Applied</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                    <td>F201210145</td>
                    <td>John Doe</td>
                    <td>2021/12/23</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary" data-tooltip="tooltip" data-placement="bottom" title="View Applicant Details" data-toggle="modal" data-target="#modal-view-exam-applicant"><i class="fas fa-user">View</i></button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /APPLICATIONS LIST -->

      </div>
      @include('portal.staff.student.exams.modal')
      @include('portal.staff.student.exams.scripts')
    </div>
    <!-- /CONTENT -->

@endsection
