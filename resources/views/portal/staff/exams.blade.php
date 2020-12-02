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

    
    <div class="col-lg-12 staff-exams">
      <div class="row">
      <!-- CREATE EXAM SHEDULE -->
      <div class="exam-shedule">
        <div class="card-header border-0 bg-transparent">Create Exam Shedule</div>
        <form action="{{ route('exams') }}" method="POST">
          @csrf
          <select name="subject" class="subject">
            <option value="fit103">ICT Applications</option>
            <option value="fit203">English for ICT</option>
            <option value="fit303">Mathematics for ICT</option>
          </select>
          
          <input type="date" name="exam-date" class="exam-select" id="exam-date">
          <input type="time" name="start-time" class="exam-select" id="start-time">
          <input type="time" name="end-time" class="exam-select" id="end-time"> <br /><br />

          <input type="submit" value="Release Shedule" class="btn btn-outline-primary" />

          
        </form>

      </div>
    </div>

      <!-- CREATE EXAM SHEDULE -->

      <!--EXAM SHEDULE TABLE -->
      <div class="row">

        <div class="col-lg-8 mt-5 px-4">
          <div class="row">
            <a class="card w-100" href="{{ route('exams') }}">



              
              <div class="card w-100">
                <div class="card-header border-0 bg-transparent">Exam Shedules</div>
                  <table class="table yajra-datatable ">
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
                      @foreach($exams as $exam)
                        <tr class="text-center">
                        <td>FIT {{ $exam->subject->code }}</td>
                          <td>{{ $exam->subject->name }}</td>
                          <td>{{ $exam->date }}</td>
                          <td> 10.00 PM</td>
                          <td> 12.00 PM </td>
                          <th><button id="remove" class="btn btn-outline-warning">Remove</button></th>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>



                <!--EXAMSHEDULE TABLE -->
                
                <!--
                <div class="card-footer border-0 bg-transparent text-right">
                  View <i class="fa fa-arrow-alt-circle-right"></i>
                </div> -->
            
              </div>
            </a>
          </div>
        </div>

 

      </div>
    </div>
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

@endsection
