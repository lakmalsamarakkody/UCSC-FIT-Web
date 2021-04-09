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
              <li class="breadcrumb-item active" aria-current="page">Assign Exams</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 exam-assign">
      <div class="row">

        <!-- SEARCH -->
        <div class="col-12 mb-5">
          <div class="card">
            <div class="card-header">Search</div>
            <div class="card-body">
                <div class="form-row mb-5">
                    <div class="form-group col-xl-2 col-lg-4">
                      <label for="searchAssignExamYear">Year</label>
                      <select name="searchAssignExamYear" id="searchAssignExamYear" class="form-control">
                        <option value="" selected>Select Year</option>
                        @foreach ($exam_years as $year)
                            <option value="{{$year->year}}">{{$year->year}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4">
                      <label for="searchAssignExam">Exam</label>
                      <select name="searchAssignExam" id="searchAssignExam" class="form-control">
                        <option value="" selected>Select Exam</option>
                        @foreach ($upcoming_exams as $exam)   
                          <option value="{{$exam->id}}">{{$exam->year}} {{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-4">
                      <label for="searchAssignExamDate">Date</label>
                      <input type="date" class="form-control" id="searchAssignExamDate" name="searchAssignExamDate" />
                    </div>
                    <div class="form-group col-xl-2 col-lg-6">
                      <label for="searchAssignSubject">Subject</label>
                      <select name="searchAssignSubject" id="searchAssignSubject" class="form-control">
                        <option value="" selected>Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-6">
                      <label for="searchAssignExamType">Exam Type</label>
                      <select name="searchAssignExamType" id="searchAssignExamType" class="form-control">
                        <option value="" selected>Select Type</option>
                          @foreach ($exam_types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-xl-2 col-lg-12">
                      <label for="btnSearchAssignExamSchedules">&nbsp;</label>
                      <button type="button" class="btn btn-outline-primary form-control" onclick="search_assign_exams();" id="btnSearchAssignExamSchedules" name="btnSearchAssignExamSchedules"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /SEARCH -->

        <!-- SCHEDULES TABLE -->
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header">Exam Schedules</div>
                <div class="card-body">
                    <table class="table assign-exam-schedules-yajradt">
                        <thead>
                          <tr>
                            <th>Exam</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Exam Type</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                          </tr>
                        </thead>
                        <tbody id="assignSchedulesTblBody">
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /SCHEDULES TABLE-->

      </div>
    </div>

    <!-- /CONTENT -->

    @include('portal.staff.exams.assign.scripts')
    @include('portal.staff.exams.assign.modal')

@endsection
