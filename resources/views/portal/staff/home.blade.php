@extends('layouts.portal')

@section('content')
    <!-- BREACRUMB -->
    <section class="col-sm-6">
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
    <div class="col-lg-12">
      <div class="row">
        <h3 class="title">Dashboard</h3>
      </div>
    </div>

    <!-- HEADING -->
    <div class="col-lg-12">
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
