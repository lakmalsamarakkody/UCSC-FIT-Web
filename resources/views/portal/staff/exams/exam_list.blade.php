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
                      <option value="Default" selected disabled>Select Month</option>
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="October">October</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                    </select>
                    <span class="invalid-feedback" id="error-examMonth" role="alert"></span>
                  </div>
                  <div class="form-group col-xl-4 col-lg-12">
                    <label for="btnCreateExam">&nbsp;</label>
                    <button type="button" class="form-control btn btn-outline-primary" data-tooltip="tooltip" title="Create Exam" data-placement="bottom" id="btnCreateExam" name="btnCreateExam" onclick="onclick_create_exam();"><i class="fas fa-plus"></i></button>
                  </div>
                  <div class="form-group col-xl-12 col-lg-12 text-center">
                    <input type="hidden" id="exam" name="exam" class="form-control" />
                    <span class="invalid-feedback" id="error-exam" role="alert"></span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /CREATE EXAM -->


        <!-- EXAM TABLE -->
        <div class="col-12 md-5">
          <div class="card">
            <div class="card-header">Exam List</div>
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
                    <td>{{ $exam->month }}</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="View Results"><i class="fas fa-eye"></i></button>
                        <button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete Exam" id="btnDeleteExam-{{$exam->id}}" onclick="onclick_delete_exam({{$exam->id}});"><i class="fas fa-trash-alt"></i></button>
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
