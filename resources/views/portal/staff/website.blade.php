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
              <li class="breadcrumb-item active" aria-current="page">Students</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->


    <!-- CONTENT -->
    <div class="col-lg-12 student">
      <div class="row">
        
        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              <div class="row justify-content-between mx-1">
                Announcements
                <button data-toggle="modal" data-target="#modal-create-announcement" title="Add Announcement" data-tooltip="tooltip"  data-placement="bottom" class="btn btn-lg btn-outline-primary"><i class="fa fa-plus"></i></button>
              </div>
            </div>
            <div class="card-body">
              
              <div class="mt-2">              
                <table class="table yajra-datatable">
                  <thead class="text-center">
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Created At</th>
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

      </div>
    </div>
    <!-- /CONTENT -->
    @include('portal.staff.website.modal')


@endsection

@include('portal.staff.website.scripts')