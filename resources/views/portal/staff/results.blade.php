@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#results').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-10 mb-3">
        <div class="row">           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Results</li>
            </ol>
          </nav>
        </div>
    </section>
    <div class="col-sm-2">
      <div class="row">
        
        <div class="w-100 text-right pr-4">
          <button class="btn w-100 btn-lg btn-info float-right pull-right" data-toggle="modal" data-target="#importResults">
            <i class="fa fa-file-import"></i>
             &nbsp; Import Results
          </button>
        </div>
      </div>
    </div>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 results">
      <div class="row">
        <!-- <div class="col-lg-2"></div> -->

        <div class="col-lg-12">

            <div class="card">
              <div class="card-header">
                Filters
              </div>
              <div class="card-body">
                <form action="{{ route('students') }}" method="GET">
                  <div class="form-row">
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col">
                      <select id="year" name="year" class="form-control ">
                        <option selected>Year</option>
                        @foreach($years as $year)                          
                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col">
                      <select id="month" name="month" class="form-control ">
                        <option selected>Month</option>
                        <option value="january">January</option>
                        <option value="february">February</option>
                        <option value="march">January</option>
                        <option value="april">January</option>
                        <option value="may">January</option>
                        <option value="june">January</option>
                        <option value="july">January</option>
                        <option value="august">January</option>
                        <option value="september">January</option>
                        <option value="october">January</option>
                        <option value="november">January</option>
                        <option value="december">January</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-1"></div>
                  </div>
                </form>
              </div>
            </div>

        </div>
        <!-- <div class="col-lg-1"></div> -->
        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              Results
            </div>
            <div class="card-body">
              <div class="col-lg-12">
                @foreach($exams as $exam)
                <div class="card my-2">
                  <div class="card-header align-middle">
                    <div class="row">
                      <div class="col-sm-8">
  
                        <h3 class="mb-0">{{ $exam->year }}&nbsp; {{ $exam->month }}</h5> 
                      </div>
                      <div class="col-sm-4">
                        <a class="btn btn-outline-success w-100 text-center" href="{{ url('/portal/staff/result/view/') }}/{{ $exam->id }}" target="_blank">
                          <i class="fa fa-eye"></i>
                          &nbsp;View Results
                        </a>
                      </div>
                    </div>

                  </div>
                </div>

                  
                @endforeach
                <div class="pt-4 float-right">
                  {{ $exams->links( "pagination::bootstrap-4") }}
                </div>
              </div>
              
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /CONTENT -->


@include('portal.staff.result.modal')

@endsection

@include('portal.staff.result.scripts')