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
        <div class="col-lg-2">
          <div class="card border-0 bg-transparent shadow">
            <div class="card-header border-0 bg-transparent">Registered</div>
            <div class="card-body">
              <div class="card-title">125</div>
              <div class="card-text">125</div>
            </div>
            <div class="card-footer d-none">test</div>
          </div>
        </div>
        
        <div class="col-lg-2">
          <div class="card">
            <div class="card-header">test</div>
            <div class="card-body">
              <div class="card-title">test</div>
              <div class="card-text">test</div>
            </div>
            <div class="card-footer d-none">test</div>
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
