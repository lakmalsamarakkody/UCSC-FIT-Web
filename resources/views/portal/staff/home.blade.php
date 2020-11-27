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

    <!-- HEADING -->
    <div class="col-lg-12 mb-4">
      <div class="row">
        <h3 class="title">Dashboard</h3>
      </div>
    </div>
    <!-- /HEADING -->

    <!-- CONTENT -->
    <div class="col-lg-12 dashboard">
      <div class="row">

        <!-- SUMMARY CARDS -->
        <div class="col-lg-2 px-1">
          <a class="card" href="">
            <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">5000</div>
              </div>
              <div class="card-header border-0 bg-transparent text-center p-0"><h1>new Applicants</h1></div>
              <div class="card-footer border-0 bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>
        
        <div class="col-lg-2 px-1">
          <a class="card" href="">
            <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">125</div>
              </div>
              <div class="card-header border-0 bg-transparent text-center p-0"><h1>Payments to Review</h1></div>
              <div class="card-footer border-0 bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 px-1">
          <a class="card" href="">
            <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">100</div>
              </div>
              <div class="card-header border-0 bg-transparent text-center p-0"><h1>Documents Pending</h1></div>
              <div class="card-footer border-0 bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 px-1">
          <a class="card" href="">
            <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">95</div>
              </div>
              <div class="card-header border-0 bg-transparent text-center p-0"><h1>Documents to Review</h1></div>
              <div class="card-footer border-0 bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>
        
        <div class="col-lg-2 px-1">
          <a class="card" href="">
            <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">1500</div>
              </div>
              <div class="card-header border-0 bg-transparent text-center p-0"><h1>Total Registered</h1></div>
              <div class="card-footer border-0 bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>

        <div class="col-lg-2 px-1">
          <a class="card" href="">
            <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
              <div class="card-body p-0 my-0 ">
                <div class="card-title text-center m-0">2</div>
              </div>
              <div class="card-header border-0 bg-transparent text-center p-0"><h1>Medicals to Review</h1></div>
              <div class="card-footer border-0 bg-transparent text-right">View <i class="fa fa-arrow-alt-circle-right"></i></div>
            </div>
          </a>
        </div>
        <!-- SUMMARY CARDS -->

        <div class="col-lg-6 mt-5 pr-5">
          <div class="row">
            
            <h2 class="mb-4">Upcoming Exams</h2>
            <table class="table table-bordered yajra-datatable px-5">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Subject Code</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
  
          </div>
        </div>

        
        <div class="col-lg-6 mt-5 pl-5">
          <div class="row">
            
            <h2 class="mb-4">Exams Held</h2>
            <table class="table table-bordered yajra-datatable px-5">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Subject Code</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
  
          </div>
        </div>

      </div>
    </div>
    <!-- /CONTENT -->


    <script type="text/javascript">
      $(function () {
        
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('exam-list') }}",
            columns: [
                {data: 'date', name: 'Date'},
                {data: 'subject_code', name: 'Subject Code'},
                {data: 'subject_name', name: 'Subject'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
        
      });
    </script>

@endsection
