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
              <li class="breadcrumb-item active" aria-current="page">Exams</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    
    <div class="col-12 staff-exams">
      <div class="row">
        <div class="col-12 mb-5">

      <!-- CREATE EXAM SHEDULE -->
            <div class="card">
              <div class="card-header">Create Exam Shedule</div>
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-xl-3 col-lg-6">
                      <label for="subject">Subejct</label>
                      <select name="subject" id="subject" class="form-control">
                        <option value="">ICT Applications</option>
                        <option value="">English for ICT</option>
                        <option value="">Mathematics for ICT</option>
                      </select>
                    </div>
                    <div class="form-group col-xl-3 col-lg-6">
                      <label for="exam_date">Date</label>
                      <input type="date" name="exam_date" class="form-control"/>
                    </div>
                    <div class="form-group col-xl-2 col-lg-6">
                      <label for="start_time">Start Time</label>
                      <input type="time" name="start_time" class="form-control"/>
                    </div>
                    <div class="form-group col-xl-2 col-lg-6">
                      <label for="end_time">End Time</label>
                      <input type="time" name="exam_date" class="form-control"/>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-outline-primary" onclick="release_shedule()">RELEASE SHEDULE</button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>

      <!-- /CREATE EXAM SHEDULE -->



        <!-- EXAM SHEDULE TABLE -->
              <div class="card">
                <div class="card-header">Exam Shedules</div>
                <div class="card-body">
                  <table class="table yajra-datatable">
                    <thead class="text-center">
                      <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($exams as $exam)
                      <tr class="text-center">
                        <td>FIT {{ $exam->subject->code }}</td>
                        <td>{{ $exam->subject->name }}</td>
                        <td>{{ $exam->date }}</td>
                        <td>10.00AM</td>
                        <td>12.00PM</td>
                        <td><button class="btn btn-outline-danger">Remove</button></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
    
                </div>
    
        </div>
      </div>

    </div>
    <!-- /EXAM SHEDULE TABLE-->
 

    <!-- /CONTENT -->



    <!-- HEADING -->

    <!--
    <div class="col-lg-12 mt-5">
        <div class="row">
          
          <div class="card w-100">
              <div class="card-header">{{ __('Dashboard') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{ __('You are logged in as Staff!') }}
              </div>
          </div>

      </div>
    </div> -->

    @include('portal.staff.exams.scripts')

@endsection
