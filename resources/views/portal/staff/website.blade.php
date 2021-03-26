@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#website').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Website</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 min-vh-100 website">
      <div class="row">
        
        @if(Auth::user()->hasPermission('staff-website-announcement'))
        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              <div class="row justify-content-between mx-1">
                Announcements
                @if(Auth::user()->hasPermission('staff-website-announcement-add'))
                <button data-toggle="modal" data-target="#modal-create-announcement" title="Add Announcement" data-tooltip="tooltip"  data-placement="bottom" class="btn btn-lg btn-outline-primary" onclick="refresh_modal()"><i class="fa fa-plus"></i></button>
                @endif
              </div>
            </div>
            <div class="card-body">
              
              <div class="mt-2">              
                <table class="table yajra-datatable">
                  <thead class="text-center">
                    <tr>
                      <th>Title</th>
                      <th>Created at</th>
                      <th>Last updated at</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
        @endif

      </div>
    </div>
    <!-- /CONTENT -->
    @include('portal.staff.website.modal')


@endsection

@include('portal.staff.website.scripts')