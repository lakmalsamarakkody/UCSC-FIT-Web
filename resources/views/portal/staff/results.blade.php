@extends('layouts.portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#results').addClass("active");
    });

</script>
    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Results</li>
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
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
