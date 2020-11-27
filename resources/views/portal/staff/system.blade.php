@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#system').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">System</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    <div class="col-md-12 system">
      <div class="row">

        <!-- USER ROLE -->
        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-header">USER ROLE</div>
            <div class="card-body">
              <div class="card-text">
                <table class="table table-responsive-md">
                  <thead>
                    <tr>
                      <th>Role Name</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <thead>
                    <tr>
                      <td>System Administrator</td>
                      <td class="text-right">
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-success"><i class="fas fa-eye"></i></button>
                          <button type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="card-footer"><button type="button" class="btn btn-outline-primary"><i class="fas fa-plus"></i></button></div>
          </div>
        </div>
        <!-- /USER ROLE -->

        <!-- SUBJECT -->
        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-header">SUBJECTS</div>
            <div class="card-body">
              <div class="card-text">
                <table class="table table-responsive-md">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Name</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <thead>
                    <tr>
                      <td><b>FIT 103</b></td>
                      <td>ICT Applications</td>
                      <td class="text-right">
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="card-footer"><button type="button" class="btn btn-outline-primary"><i class="fas fa-plus"></i></button></div>
          </div>
        </div>
        <!-- /SUBJECT -->

        <!-- EXAM TYPE -->
        <div class="col-xl-4 col-lg-12">
          <div class="card">
            <div class="card-header">EXAM TYPES</div>
            <div class="card-body">
              <div class="card-text">
                <table class="table table-responsive-md">
                  <thead>
                    <tr>
                      <th>Type Name</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <thead>
                    <tr>
                      <td>e-Test</td>
                      <td class="text-right">
                        <div class="btn-group">
                          <button type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button>
                          <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="card-footer"><button type="button" class="btn btn-outline-primary"><i class="fas fa-plus"></i></button></div>
          </div>
        </div>
        <!-- /EXAM TYPE -->

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
