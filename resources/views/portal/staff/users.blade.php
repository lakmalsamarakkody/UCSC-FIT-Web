@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#users').addClass("active");
    });

</script>
  <!-- BREACRUMB -->
  <section class="col-sm-12 mb-3">
      <div class="row">
          
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
          </ol>
        </nav>

      </div>
  </section>
  <!-- /BREACRUMB -->


  <!-- CONTENT -->
  <div class="col-lg-12 users">
    <div class="row">

      <!-- SEARCH -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">SEARCH</div>
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group col-12">
                  <div class="input-group input-group-md">
                    <div class="input-group-prepend">
                      <button type="button" class="form-control btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter search details.."/>
                    <div class="input-group-append">
                      <button type="button" class="form-control btn btn-primary"><i class="fa fa-search"></i>&nbsp;Search</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="collapse" id="collapseFilters">
              <div class="card shadow-none">
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="InputStudentName">Name</label>
                      <input type="text" class="form-control form-control-sm" id="InputStudentName" aria-describedby="InputStudentNameHelp"/>
                      <small id="InputStudentNameHelp" class="form-text text-muted">any help text</small>
                    </div>
                    <div class="form-group col">
                      <label for="InputStudentNIC">NIC</label>
                      <input type="text" class="form-control form-control-sm" id="InputStudentNIC" aria-describedby="InputStudentNICHelp"/>
                      <small id="InputStudentNICHelp" class="form-text text-muted">any help text</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /SEARCH -->

      {{-- USER LIST --}}
      <div class="col-md-12 mt-4">
        <div class="card">
          <div class="card-header">Users</div>
          <div class="card-body">
            <table class="table user-list-yajradt">
              <thead class="text-center">
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody class="text-center">
              </tbody>
            </table>
          </div>
        </div>
        {{-- /USER LIST --}}

    </div>
  </div>
  <!-- /CONTENT -->
@endsection

@section('script')
  @include('portal.staff.user.scripts')
@endsection
