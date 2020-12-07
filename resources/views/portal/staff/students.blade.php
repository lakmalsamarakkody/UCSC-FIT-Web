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
    <div class="col-lg-12 student">
      <div class="row">
        <!-- <div class="col-lg-2"></div> -->

        <div class="col-lg-12">

            <div class="card   ">
              <div class="card-header">
                Filters
              </div>
              <div class="card-body">
                <form action="{{ route('students') }}" method="GET">
                  <div class="form-row">
                    <div class="form-group col-lg-3">
                      <select id="inputState" name="inputState" class="form-control ">
                        <option selected>Year</option>
                        @foreach($years as $year)                          
                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-lg-9 mb-3">
                      <div class="input-group input-group-md">
                        <div class="input-group-prepend">
                          <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="">Filters <i class="fa fa-filter"></i></span>
                          </button> 
                          <ul class="dropdown-menu p-3">
                            <li>                              
                              <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label p-1" for="exampleCheck1">Registration No</label>
                              </div>
                            </li>
                            <li>
                              <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label p-1" for="exampleCheck1">Name</label>
                              </div>
                            </li>
                            <li>
                            </li>
                          </ul>
                          <div class="dropdown-menu p-3">
                              <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label p-1" for="exampleCheck1">Registration No</label>
                              </div>
                              <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label p-1" for="exampleCheck1">Name</label>
                              </div>

                          </div>
                          

                        </div>
                        <input type="text" class="form-control">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-outline-primary" id="btnSearch">
                            <i class="fa fa-search"></i> Search
                          </button>
                        </div>
                      </div>
                      
                    </div>

                  </div>

                </form>
              </div>
            </div>

        </div>
        <!-- <div class="col-lg-1"></div> -->
        <div class="col-lg-12">
          <div class="card shadow  mt-3">
            <div class="card-header">
              Students
            </div>
            <div class="card-body">
              <table class="table yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th>Registration No</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>BIT Eligibility</th>
                    <th>FIT Certificate</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  <!-- @foreach($students as $student)
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
                        <button title="View Profile" data-toggle="tooltip" data-placement="left" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-view-role"><i class="fas fa-user"></i></button>
                    </td>
                  </tr>
                  @endforeach -->
                </tbody>
              </table>
              <!-- <div class="float-right">
                {{ $students->links( "pagination::bootstrap-4") }}
              </div> -->
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /CONTENT -->


@endsection

@include('portal.staff.student.scripts')