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
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/users') }}">Users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 user">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">User Details</div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-8">
                    <table class="table">
                      <tr>
                          <th>Email:</th>
                          <td>John@gmail.com <span class="badge badge-pill badge-success">Verified</span></td>
                          <td class="text-right"><button class="btn btn-sm btn-danger">Reset</button></td>
                      </tr>
                      <tr>
                        <th>Password:</th>
                        <td>xxxxxxxxxxxxxxxx</td>
                        <td class="text-right"><button class="btn btn-sm btn-danger">Reset</button></td>
                      </tr>
                      <tr>
                        <th>Status:</th>
                        <td><span class="badge badge-pill badge-success">Active</span></td>
                        <td class="text-right"><button class="btn btn-sm btn-danger">Deactivate</button></td>
                      </tr>
                    </table>
                </div>
                <div class="col-lg-4 ">  
                    <div class="row">                               
                        <div class="img my-2 text-center">
                            <img src="{{ asset('img/portal/avatar') }}/{{ Auth::user()->id }}.png" alt="Avatar" class="avatar" width="50%">
                        </div>
                    </div>   
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /CONTENT -->
<div class="mb-5">&nbsp;</div>

 @include('portal.staff.student.scripts')

@endsection
