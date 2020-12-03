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

      <!-- CREATE EXAM SHEDULE -->

      <div class="col-10 mt-5 mx-4">
        <div class="row">
          <div class="card w-100 create-exam">
            <div class="card border-0 bg-transparent w-100" style="height: 15rem;">
              <div class="header border-0 bg-transparent">Create Exam Shedule</div>
              <div class="card-body px-0">
              <form action="{{ route('exams') }}" method="POST">
                @csrf
                <div class="col-12 px-4">
                  <div class="row">
                    <label for="subject">Subject</label>
                    <select class="col-xl-3 col-lg-4 mx-3 mt-2 row form-control" name="subject" id="subject">
                      <option value="" selected disabled>Subject</option>
                      <option value="">ICT Applications</option>
                      <option value="">Mathematics for ICT</option>
                      <option value="">English for ICT</option>
                    </select>
                    <label class="col-lg-3 col-md-4 mt-2 mx-3 row" for="exam-date">Exam Date</label>
                    <input type="date" name="exam-date" id="exam-date" />
                    <label class="col-lg-2 col-md-4 mt-2 mx-3 row" for="start-time">Start Time</label>
                    <input  type="time" name="start-time" id="start-time"/>
                    <label for="end-time">End Time</label>
                    <input class="col-lg-2 col-md-4 mt-2 mx-3 row" type="time" name="end-time" id="end-time"/>

                  </div> <br /><br />
                  <div class="text-center">
                    <input type="submit" value="RELEASE SHEDULE" class="btn btn-outline-primary">

                  </div>
                  
                  

                </div>
                    
              
              </form>
              </div>

            </div>


          </div>
        </div>
      </div>


      <!-- /CREATE EXAM SHEDULE -->



        <!-- EXAM SHEDULE TABLE -->
        <div class="col-lg-10 col-md-12 mt-5 mx-4">
          <div class="row">
            <a class="card w-100" href="{{ route('exams') }}" style="height: 31.5rem;">
              <div class="card border-0 bg-transparent w-100" style="height: 31.5rem">
                <div class="card header border-0 bg-transparent" style="height: 4rem;">Exam Shedules</div>
                <div class="card-body px-0">
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
    
              
    
            </a>
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

@endsection
