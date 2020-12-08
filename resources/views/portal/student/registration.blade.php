@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#registration').addClass("active");
    });

</script>

<!--
<script type="text/javascript">
    // SHOW INPUT FILED IN TITLE
    function showfield(name){
      if(name=='Other')document.getElementById('oth').innerHTML='<input type="text" class="form-control" name="other" />';
      else document.getElementById('oth').innerHTML='';
    }
</script> -->

    <!-- BREACRUMB -->
    <section class="col-sm-12 mb-3">
        <div class="row">
           
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb ">
              <li class="breadcrumb-item"><a href="{{ url('/portal/student/') }}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Registration</li>
            </ol>
          </nav>

        </div>
    </section>
    <!-- /BREACRUMB -->

    <!-- CONTENT -->
    <div class="col-12 student-registration">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-header text-center">Register to FIT <br><small style="color:slategrey; text-transform: initial;">Please fill all the details correctly</small></div>
                    <div class="card-body">
                        <form>
                            <div class="details px-3">
                                <h6 class="text-left mt-4 mb-5">Personal Details</h6>
                                <div class="form-row align-item-center">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Kamal"/>
                                    </div>
                                    <div class="from-group col-xl-6 col-md-12">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Atthanayke">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="otherName">Other Name</label>
                                        <input type="text" class="form-control" id="otherName" name="otherName" placeholder="Kankanange">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="nameInitials">Name with Initials</label>
                                        <input type="text" class="form-control" id="nameInitials" name="nameInitials" placeholder="K K Atthanayke">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="title">Title</label>
                                        <select name="title" id="title" onchange="showfield(this.options[this.selectedIndex].value)" class="form-control">
                                            <option value="">Rev</option>
                                            <option value="">Dr</option>
                                            <option value="" selected>Mr</option>
                                            <option value="">Miss</option>
                                            <option value="">Mrs</option>
                                            <option value="">Other(Specify)</option>
                                        </select>
                                       <!-- <div class="col-xl-6 col-md-12" id="divOther"></div> -->
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Male</option>
                                            <option value="">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="citizenship">Citizenship</label>
                                        <select name="citizenship" id="citizenship" class="form-control">
                                            <option value="">Sri Lankan</option>
                                            <option value="">Foreign National</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="nic">Narional ID / Passport No.</label>
                                        <input type="text" class="form-control" id="nic" name="nic" placeholder="960342704V">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="qulification">Highest Qualification</label>
                                        <select name="qulification" id="qulification" class="form-control">
                                            <option value="">Bachelor's Degree</option>
                                            <option value="">GCE Advanced Level</option>
                                            <option value="">GCE Ordinary Level</option>
                                        </select>
                                    </div>




                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /CONTENT -->


     <!-- HEADING -->

    <!--
    <div class="col-lg-12 mt-5">
        <div class="row">
          
          <div class="card w-100">
              <div class="card-header">{{ __('Dashboard') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{ __('You are logged in as Staff!') }}
              </div>
          </div>

      </div>
    </div> -->


    
@endsection