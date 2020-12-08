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
              Results
            </div>
            <div class="card-body">
              <table class="table table-bordered yajra-datatable">
                <thead class="text-center">
                  <tr>
                    <th rowspan="2">Registration No</th>
                    <th rowspan="2">Name</th>
                    <th colspan="4">FIT 103</th>
                    <th colspan="4">FIT 203</th>
                    <th rowspan="2" colspan="2">FIT 303</th>
                    <th rowspan="2">&nbsp;</th>
                  </tr>
                  <tr>
                    <th colspan="2">E Test</th>
                    <th colspan="2">Practical</th>
                    <th colspan="2">E Test</th>
                    <th colspan="2">Practical</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                @foreach($results as $result)
                    <tr>
                      <td>{{ $result}}</td>
                      <td> </td>
                      <td>75</td>
                      <td><i class="fa fa-check"></i></td>
                      <td>45</td>
                      <td><i class="fa fa-times"></i></td>
                      <td>35</td>
                      <td><i class="fa fa-times"></i></td>
                      <td>35</td>
                      <td><i class="fa fa-times"></i></td>
                      <td>75</td>
                      <td><i class="fa fa-check"></i></td>
                      <td><button data-toggle="modal" data-target="#exampleModal" title="View Profile" data-tooltip="tooltip" data-placement="bottom"  type="button" class="btn btn-outline-warning"><i class="fas fa-share"></i></button></td>
                    </tr>                  
                @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
