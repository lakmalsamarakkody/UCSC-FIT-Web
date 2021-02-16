@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#exams').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/exams')}}">Exams</a></li>
              <li class="breadcrumb-item active" aria-current="page">Exam List</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 exams-list">
      <div class="row">

        <!-- CREATE EXAM -->
        @if(Auth::user()->hasPermission('staff-exam-examList-add'))
        <div class="col-12 mb-5">
          <div class="card">
            <div class="card-header">Create Exam</div>
            <div class="card-body">
              <form id="formCreateExam" action="" method="POST">
                <div class="form-row align-items-center px-4">
                  <div class="form-group col-xl-4 col-lg-6">
                    <label for="examYear">Year</label>
                    <select name="examYear" id="examYear" class="form-control">
                      <option value="Default" selected disabled>Select Year</option>
                      <option value="{{now()->year}}">{{now()->year}}</option>
                      <option value="{{now()->year+1}}">{{now()->year+1}}</option>
                    </select>
                    <span class="invalid-feedback" id="error-examYear" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-4 col-lg-6">
                    <label for="examMonth">Month</label>
                    <select name="examMonth" id="examMonth" class="form-control">
                      <option value="" selected disabled>Select Month</option>
                      <option value=01>January</option>
                      <option value=02>February</option>
                      <option value=03>March</option>
                      <option value=04>April</option>
                      <option value=05>May</option>
                      <option value=06>June</option>
                      <option value=07>July</option>
                      <option value=08>August</option>
                      <option value=09>September</option>
                      <option value=10>October</option>
                      <option value=11>November</option>
                      <option value=12>December</option>
                    </select>
                    <span class="invalid-feedback" id="error-examMonth" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-4 col-lg-12">
                    <label for="btnCreateExam">&nbsp;</label>
                    <button type="button" class="form-control btn btn-outline-primary" data-tooltip="tooltip" title="Create Exam" data-placement="bottom" id="btnCreateExam" name="btnCreateExam" onclick="onclick_create_exam();"><i class="fas fa-plus"></i></button>
                  </div>
                  <div class="form-group col-xl-12 col-lg-12 text-center">
                    <input type="hidden" id="exam" name="exam" class="form-control" />
                    <span class="alert alert-danger invalid-feedback" id="error-exam" role="alert"></span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endif
        <!-- /CREATE EXAM -->


        <!-- EXAM TABLE -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Exams</div>
            <div class="card-body">
              <table class="table yajra-datatable tableExam">
                <thead class="text-center">
                  <tr>
                    <th>Year</th>
                    <th>Month</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody class="text-center" id="tbodyExam">
                  @foreach ($exams as $exam)
                  <tr id="tbl-exam-tr-{{$exam->id}}">
                    <td>{{ $exam->year }}</td>
                    <td>{{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}}</td>
                    <td>
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-exam-examList-viewResults'))<button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="View Results"><i class="fas fa-eye"></i></button>@endif
                        @if(Auth::user()->hasPermission('staff-exam-examList-delete'))<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete Exam" id="btnDeleteExam-{{$exam->id}}" onclick="onclick_delete_exam({{$exam->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /EXAM TABLE-->

      </div>
    </div>

    <!-- /CONTENT -->

    @include('portal.staff.exams.list.scripts')

@endsection
