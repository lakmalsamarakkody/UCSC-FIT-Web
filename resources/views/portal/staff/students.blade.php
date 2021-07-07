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
         <div class="card">
          <div class="card-header">
            Filters
            @if(Auth::user()->hasPermission("staff-student-downloadStdList"))
            <div class="btn-group  float-right" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle border-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:rgb(14, 97, 25) !important">
                <i class="fa fa-file-download"></i> student list
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item text-capitalize" href="{{ url('/portal/staff/student/list/export/lastday') }}">Last Day</a>
                <a class="dropdown-item text-capitalize" href="{{ url('/portal/staff/student/list/export/lastweek') }}">Last Week</a>
                <a class="dropdown-item text-capitalize" href="{{ url('/portal/staff/student/list/export/lastmonth') }}">Last Month</a>
              </div>
            </div>
            @endif
          </div>
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group col-12">
                  <div class="input-group input-group-md">
                    <div class="input-group-prepend">
                      <button type="button" class="form-control btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                    </div>
                    <input id="searchAll" type="text" class="form-control" placeholder="Enter search details.."/>
                    <div class="input-group-append">
                      <button type="button" class="form-control btn btn-primary" onclick="search()"><i class="fa fa-search"></i>&nbsp;Search</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="collapse" id="collapseExample">
                <div class="card shadow-none">
                  <div class="card-body">
                    <div class="form-row">                    
                      <div class="form-group col-xl-2 col-lg-4">
                        <label for="year">Year</label>
                        <select id="year" name="year" class="form-control form-control-sm">
                          <option value="">select here---</option>
                          {{-- @foreach($years as $year)                          
                          <option value="{{ $year->year }}">{{ $year->year }}</option>
                          @endforeach --}}
                        </select>
                      </div>
                      <div class="form-group col-xl-2 col-lg-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-sm" id="name" aria-describedby="nameHelp"/>
                        <small id="nameHelp" class="form-text text-muted">Enter Name Here</small>
                      </div>
                      <div class="form-group col-xl-2 col-lg-4">
                        <label for="regNo">Reg: Number</label>
                        <input type="text" class="form-control form-control-sm" id="regNo" aria-describedby="regNoHelp"/>
                        <small id="regNoHelp" class="form-text text-muted">Enter Registration Number Here</small>
                      </div>
                      <div class="form-group col-xl-2 col-lg-4">
                        <label for="nic">NIC/Postal/Passport</label>
                        <input type="text" class="form-control form-control-sm" id="nic" aria-describedby="nicHelp"/>
                        <small id="nicHelp" class="form-text text-muted">Enter NIC/Postal/Passport Here</small>
                      </div>                  
                      <div class="form-group col-xl-2 col-lg-4">
                        <label for="bit">BIT</label>
                        <select id="bit" name="bit" class="form-control form-control-sm">
                          <option value="">select here---</option>
                          <option value="1">Eligible</option>
                          <option value="0">Not-Eligible</option>
                        </select>
                      </div>            
                      <div class="form-group col-xl-2 col-lg-4">
                        <label for="fit">FIT Certificate</label>
                        <select id="fit" name="fit" class="form-control form-control-sm">
                          <option value="">select here---</option>
                          <option value="1">Eligible</option>
                          <option value="0">Not-Eligible</option>
                        </select>
                      </div>
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
                    <th>NIC/Postal/Passport</th>
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

@include('portal.staff.student.scripts')