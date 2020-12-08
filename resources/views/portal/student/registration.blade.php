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
                            <!-- Personal Details -->
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
                            <!-- /Personal Details -->

                            <!-- Contact Details -->
                            <div class="details px-3 mt-4">
                                <h6 class="text-left mt-4 mb-5">Contact Details</h6>
                                <div class="form-row align-item-center">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="house">Permenent Address</label>
                                        <input type="text" class="form-control" id="house" name="house" placeholder="No:20">
                                        <input type="text" class="form-control" id="street1" name="street1" placeholder="First lane">
                                        <input type="text" class="form-control" id="street2" name="street2" placeholder="Kandy Road">
                                        <input type="text" class="form-control" id="city1" name="city1" placeholder="Senkadagala">
                                        <input type="text" class="form-control" id="city2" name="city2" placeholder="Kandy">
                                        <!--<button type="button" class="btn btn-outline-primary form-control" onclick="add_field();" id="addField" name="addField"><i class="fas fa-plus"></i></button> -->
                                        
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="curruntHouse">Current Address (Optional)</label>
                                        <input type="text" class="form-control" id="curruntHouse" name="curruntHouse" placeholder="No:20" class="mb">
                                        <input type="text" class="form-control" id="currentStreet1" name="currentStreet1" placeholder="First Lane">
                                        <input type="text" class="form-control" id="currentStreet2" name="currentStreet2" placeholder="Kandy Road">
                                        <input type="text" class="form-control" id="currentCity1" name="currentCity1" placeholder="Senkadagala">
                                        <input type="text" class="form-control" id="currentCity2" name="currentCity2" placeholder="Kandy">
                                        <!--<button type="button" class="btn btn-outline-primary form-control" onclick="add_field();" id="addField" name="addField"><i class="fas fa-plus"></i></button> -->
                                        
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Sri Lanka">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="telephone">Telephone Number</label>
                                        <input type="tel" class="form-control" id="telephone" name="telephone" >
                                    </div>

                                    <div class="form-group col-xl-12 col-md-12">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                            </div>
                            <!-- /Contact Details -->
                            <p style="color: red;" class="mt-3">* Please double check the details you entered before submit.</p>
                            <div class="text-left">
                                <button type="submit" class="btn btn-outline-primary" onclick="">Submit Application</button>
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