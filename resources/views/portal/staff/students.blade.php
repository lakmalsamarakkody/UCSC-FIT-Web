@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#students').addClass("active");
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
    <div class="col-lg-12 students">
      <div class="row">

        <div class="col-lg-10 w-100">
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <button type="button" class="btn btn-outline-secondary">Action</button>
                <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
              </div>
              <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
            </div>

          </div>
        </div>

        <div class="card shadow w-100 mt-3">
          <div class="card-header">
            Students
          </div>
          <div class="card-body">
            <table class="table table-responsive-md">
              <thead class="text-center">
                <tr>
                  <td>Registration No</td>
                  <td>Name</td>
                  <td>NIC</td>
                  <td>BIT Eligibility</td>
                  <td>FIT Certificate</td>
                  <td>&nbsp;</td>
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($students as $student)
                <tr>
                  <td>{{ $student->reg_no }}</td>
                  <td>{{ $student->full_name }}</td>
                  <td>{{ $student->nic }}</td>

                  @if($student->flag->bit_eligible)
                    <td>Eligible</td>                    
                  @else                    
                    <td>Not Eligible</td>             
                  @endif
                  @if($student->flag->fit_cert)
                    <td>Eligible</td>                    
                  @else                    
                    <td>Not Eligible</td>             
                  @endif
                  <td>                    
                    <div class="btn-group">
                      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-view-role"><i class="fas fa-eye"></i></button>
                      <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal-edit-role"><i class="fas fa-edit"></i></button>
                      <button type="button" class="btn btn-outline-danger" onclick="delete_role();"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
    <!-- /CONTENT -->


@endsection
