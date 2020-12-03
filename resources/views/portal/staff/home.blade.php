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
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 dashboard">
      <div class="row">

        <!-- SUMMARY CARDS -->
        <div class="col-xl-2 col-lg-4 p-1">
          <a class="" href="">
            <div class="card card-dash shadow green" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">5000</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>new Applicants</h1></div>
              <div class="card-footer bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>
        
        <div class="col-xl-2 col-lg-4 p-1">
          <a class="" href="">
            <div class="card card-dash shadow red" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">125</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Payments to Review</h1></div>
              <div class="card-footer bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          <a class="" href="">
            <div class="card card-dash shadow black" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">100</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Documents Pending</h1></div>
              <div class="card-footer bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          <a class="" href="">
            <div class="card card-dash shadow yellow" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">95</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Documents to Review</h1></div>
              <div class="card-footer bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>
        
        <div class="col-xl-2 col-lg-4 p-1">
          <a class="" href="">
            <div class="card card-dash shadow black" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">1500</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Total Registered</h1></div>
              <div class="card-footer bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>

        <div class="col-xl-2 col-lg-4 p-1">
          <a class="" href="">
            <div class="card card-dash shadow red" style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">2</div>
              </div>
              <div class="card-header bg-transparent text-center p-0"><h1>Medicals to Review</h1></div>
              <div class="card-footer bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>
        <!-- SUMMARY CARDS -->

        <div class="col-lg-6 col-md-12 mt-5 px-1">
            <a class="" href="{{ route('exams') }}" style="height: 30rem;">
              <div class="card" style="height: 30rem;">
                <div class="card-header">Upcoming Exams</div>
                <div class="card-body px-0">
                  <table class="table yajra-datatable ">
                    <thead class="text-center">
                        <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>Exam Type</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($upcomings as $upcoming)
                        <tr class="text-center">
                          <td>{{ $upcoming->date }}</td>
                          <td>{{ $upcoming->subject->name }}</td>
                          <td>{{ $upcoming->type->exam_type }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
                <div class="card-footer text-right">
                  View <i class="fa fa-arrow-alt-circle-right"></i>
                </div>
            
              </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12 mt-5 px-1">
            <a class="" href="{{ route('exams') }}" style="height: 30rem;">
              <div class="card overflow-auto" style="height: 30rem;">
                <div class="card-header">Exams Held</div>
                <div class="card-body px-0">
                  <table class="table yajra-datatable ">
                    <thead class="text-center">
                        <tr>
                          <th>Date</th>
                          <th>Subject</th>
                          <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($dones as $done)
                        <tr class="text-center">
                          <td>{{ $done->date }}</td>
                          <td>{{ $done->subject->name }}</td>
                          <td>{{ $done->type->exam_type }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
                <div class="card-footer text-right">
                  View <i class="fa fa-arrow-alt-circle-right"></i>
                </div>
            
              </div>
            </a>
        </div>

        <div class="col-lg-12">
          <span>
            &nbsp; <br>
            
            &nbsp; <br>
            &nbsp; <br>
          </span>
        </div>


      </div>
    </div>
    <!-- /CONTENT -->




@endsection
