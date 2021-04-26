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

    <!-- IMPORT RESULTS -->
    @if(Auth::user()->hasPermission('staff-result-import'))
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
    @endif
    <!-- /IMPORT RESULTS -->


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
                        <option selected value="">Year</option>
                        @foreach($years as $year)                          
                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col">
                      <select id="month" name="month" class="form-control ">
                        <option selected value="">Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
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
              <table class="table yajra-datatable">
                <tbody class="text-center">
                </tbody>
              </table>

              {{-- <div class="col-lg-12">
                @foreach($exams as $exam)
                <div class="card my-1">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-sm-8">
                        <h4>{{ $exam->year }} {{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}}</h4> 
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
              </div> --}}
              
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /CONTENT -->


@include('portal.staff.result.modal')

@endsection

@include('portal.staff.result.scripts')