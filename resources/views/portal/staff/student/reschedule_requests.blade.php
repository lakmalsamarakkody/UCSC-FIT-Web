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
              <li class="breadcrumb-item active" aria-current="page">Reschedule Requests</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 medical">
      <div class="row">
          
        <!-- MEDICALS LIST -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Reschedule Requests Submitted</div>
            <div class="card-body">
              @if($payments->isEmpty())
                <div class="alert alert-info" role="alert">No results found!</div>
              @else
                <table class="table yajra-datatable">
                  <thead>
                    <tr>
                      <th>Registration No</th>
                      <th>Student Name</th>
                      <th>No. of Subjects</th>
                      <th>Date Applied</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($payments as $payment)
                      <tr>
                        <td>{{ $payment->student->reg_no }}</td>
                        <td>{{ $payment->student->initials }} {{ $payment->student->last_name }}</td>
                        <td>{{ App\Models\Student\Medical::where('payment_id', $payment->id)->count() }}</td>
                        <td>{{ $payment->created_at->isoFormat('YYYY-MM-DD') }}</td>
                        <td>
                          @if(Auth::user()->hasPermission('staff-dashboard-exam-review-medical-view'))
                          <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary" id="btnViewModalRescheduleRequest-{{ $payment->id }}" onclick="view_modal_reschedule_request({{ $payment->id }});"><i class="fas fa-user"></i> View <span id="spinnerbtnViewModalRescheduleRequest-{{ $payment->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
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
        <!-- /MEDICALS LIST -->

      </div>
      @include('portal.staff.student.reschedule_requests.modal')
      @include('portal.staff.student.reschedule_requests.scripts')
    </div>
    <!-- /CONTENT -->

@endsection