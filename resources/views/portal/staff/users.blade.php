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
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
          </ol>
        </nav>

      </div>
  </section>
  <!-- /BREACRUMB -->


  <!-- CONTENT -->
  <div class="col-lg-12 users min-vh-100">
    <div class="row">

      {{-- BUTTON GROUP --}}
      <div class="w-100 mb-4 mx-3">
        @if(Auth::user()->hasPermission('staff-user-add'))<button type="button" class="btn btn-lg btn-primary col-lg-3 col-md-4 col-12 py-4" data-toggle="modal" data-target="#newUserModal" style="text-decoration: none"><i class="fa fa-user-plus mr-3"></i> New User</button>@endif
        @if(Auth::user()->hasPermission('staff-user-permissions'))<a href="{{ route('user.permissions') }}"><button type="button" class="btn btn-lg btn-warning col-lg-3 col-md-4 col-12 py-4"><i class="fa fa-user-shield mr-3"></i> User Permissions</button></a>@endif
      </div>
      {{-- /BUTTON GROUP --}}

      {{-- NEW USER --}}
      {{-- <div class="col-lg-3 col-md-6 col-12 mb-4">
        <button class="btn w-100 p-0" data-toggle="modal" data-target="#newUserModal" style="text-decoration:none">
          <div class="card">
            <div class="card-header bg-primary text-center py-4 text-white">New User</div>
          </div>
        </button>
      </div> --}}
      {{-- /NEW USER --}}

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
                    <input id="searchAll" type="text" class="form-control" placeholder="Enter search details.."/>
                    <div class="input-group-append">
                      <button type="button" class="form-control btn btn-primary" onclick="search()"><i class="fa fa-search"></i>&nbsp;Search</button>
                    </div>
                  </div>
                </div>
              </div>
            <div class="collapse" id="collapseFilters">
              <div class="card shadow-none">
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="name">Name</label>
                      <input type="text" class="form-control form-control-sm" id="name" aria-describedby="NameHelp"/>
                      <small id="nameHelp" class="form-text text-muted">Search by name or part of the name</small>
                    </div>
                    <div class="form-group col">
                      <label for="email">Email</label>
                      <input type="text" class="form-control form-control-sm" id="email" aria-describedby="nicHelp"/>
                      <small id="emailHelp" class="form-text text-muted">Search by email or part of the email</small>
                    </div>
                    <div class="form-group col">
                      <label for="role">Role</label>
                      <select id="role" class="form-control form-control-sm">
                        <option value="">Select a user role</option>
                        @foreach($roles as $role)                          
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>
                      <small id="roleHelp" class="form-text text-muted">Search by user role</small>
                    </div>
                    <div class="form-group col">
                      <label for="status">Status</label>
                      <select id="status" class="form-control form-control-sm">
                        <option value="">Select a user status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      <small id="statusHelp" class="form-text text-muted">Search by user status</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /SEARCH -->

      {{-- USER LIST --}}
      <div class="col-md-12 mt-4">
        <div class="card">
          <div class="card-header">Users</div>
          <div class="card-body">
            <table class="table user-list-yajradt" >
              <thead class="text-center">
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody class="text-center" id="userTblBody">
              </tbody>
            </table>
          </div>
        </div>
        {{-- /USER LIST --}}

    </div>
  </div>
  <!-- /CONTENT -->
  @include('portal.staff.user.modals')

@endsection

@section('script')
  @include('portal.staff.user.scripts')
@endsection
