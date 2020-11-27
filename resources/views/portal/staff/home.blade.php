@extends('layouts.portal')

@section('content')
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item active" aria-current="page">{{--<a href="{{ url('/portal/staff') }}">--}}Dashboard</a></li>
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
          <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
            <div class="card-body p-0 my-0 ">
              <div class="card-title text-center m-0">5000</div>
            </div>
            <div class="card-header border-0 bg-transparent text-center p-0"><h1>new Applicants</h1></div>
            <div class="card-footer border-0 bg-transparent text-right"><a href="">View <i class="fa fa-arrow-alt-circle-right"></i></a></div>
          </div>
        </div>
        
        <div class="col-lg-2 px-1">
          <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
            <div class="card-body p-0 my-0 ">
              <div class="card-title text-center m-0">125</div>
            </div>
            <div class="card-header border-0 bg-transparent text-center p-0"><h1>Payments to Review</h1></div>
            <div class="card-footer border-0 bg-transparent text-right"><a href="">View <i class="fa fa-arrow-alt-circle-right"></i></a></div>
          </div>
        </div>

        <div class="col-lg-2 px-1">
          <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
            <div class="card-body p-0 my-0 ">
              <div class="card-title text-center m-0">100</div>
            </div>
            <div class="card-header border-0 bg-transparent text-center p-0"><h1>Documents Pending</h1></div>
            <div class="card-footer border-0 bg-transparent text-right"><a href="">View <i class="fa fa-arrow-alt-circle-right"></i></a></div>
          </div>
        </div>

        <div class="col-lg-2 px-1">
          <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
            <div class="card-body p-0 my-0 ">
              <div class="card-title text-center m-0">95</div>
            </div>
            <div class="card-header border-0 bg-transparent text-center p-0"><h1>Documents to Review</h1></div>
            <div class="card-footer border-0 bg-transparent text-right"><a href="">View <i class="fa fa-arrow-alt-circle-right"></i></a></div>
          </div>
        </div>
        
        <div class="col-lg-2 px-1">
          <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
            <div class="card-body p-0 my-0 ">
              <div class="card-title text-center m-0">1500</div>
            </div>
            <div class="card-header border-0 bg-transparent text-center p-0"><h1>Total Registered</h1></div>
            <div class="card-footer border-0 bg-transparent text-right"><a href="">View <i class="fa fa-arrow-alt-circle-right"></i></a></div>
          </div>
        </div>

        <div class="col-lg-2 px-1">
          <div class="card border-0 shadow card-dash " style="max-width: 18rem;">
            <div class="card-body p-0 my-0 ">
              <div class="card-title text-center m-0">2</div>
            </div>
            <div class="card-header border-0 bg-transparent text-center p-0"><h1>Medicals to Review</h1></div>
            <div class="card-footer border-0 bg-transparent text-right"><a href="">View <i class="fa fa-arrow-alt-circle-right"></i></a></div>
          </div>
        </div>
        <!-- SUMMARY CARDS -->

      </div>
    </div>
    <!-- /CONTENT -->



    <!-- HEADING -->
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
    </div>

@endsection
