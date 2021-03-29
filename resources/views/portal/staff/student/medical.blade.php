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
              <li class="breadcrumb-item active" aria-current="page">Medicals</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 medical">
      <div class="row">
          
        <!-- APPLICATIONS LIST -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Medical Submitted Students</div>
            <div class="card-body">
              @if($medicals->isEmpty())
                <div class="alert alert-info" role="alert">No results found!</div>
              @else
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>Registration No</th>
                      <th>Student Name</th>
                      <th>Date Applied</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($medicals as $medical)
                      <tr>
                        <td>{{ $medical->student_exam->student->reg_no }}</td>
                        <td>{{ $medical->student_exam->student->initials }} {{ $medical->student_exam->student->last_name }}</td>
                        <td>{{ $medical->created_at->isoFormat('YYYY-MM-DD') }}</td>
                        <td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-medical-view'))
                          <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary" id="btnViewModalAppliedMedical-{{ $medical->id }}" onclick="view_modal_medical({{ $medical->id }});"><i class="fas fa-user"></i> View <span id="spinnerBtnViewModalAppliedMedical-{{ $medical->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                          </div>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif

            </div>
          </div>
        </div>
        <!-- /APPLICATIONS LIST -->

      </div>
      @include('portal.staff.student.medical.modal')
      @include('portal.staff.student.medical.scripts')
    </div>
    <!-- /CONTENT -->

@endsection