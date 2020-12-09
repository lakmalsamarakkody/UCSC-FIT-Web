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
                    <div class="card-header text-center">Register to FIT Programme<br><small style="color:slategrey; text-transform: initial;">Please fill all the details correctly</small></div>
                    <div class="card-body">
                        <form>
                            <!-- PERSONAL DETAILS -->
                            <div class="details px-3">
                                <h6 class="text-left mt-4 mb-5">Personal Details</h6>
                                <div class="form-row align-item-center">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder=""/>
                                    </div>
                                    <div class="from-group col-xl-6 col-md-12">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="nameInitials">Name with Initials</label>
                                        <input type="text" class="form-control" id="nameInitials" name="nameInitials" placeholder="">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="title">Title</label>
                                        <select name="title" id="title" onchange="showfield(this.options[this.selectedIndex].value)" class="form-control">
                                            <option value="" disabled selected>Select your Title</option>
                                            <option value="">Rev</option>
                                            <option value="">Dr</option>
                                            <option value="">Mr</option>
                                            <option value="">Miss</option>
                                            <option value="">Mrs</option>
                                            <option value="">Other(Specify)</option>
                                        </select>
                                       <!-- <div class="col-xl-6 col-md-12" id="divOther"></div> -->
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="" disabled selected>Select your Gender</option>
                                            <option value="">Male</option>
                                            <option value="">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="citizenship">Citizenship</label>
                                        <select name="citizenship" id="citizenship" class="form-control">
                                            <option value="" selected disabled>Select your Citizenship</option>
                                            <option value="">Sri Lankan</option>
                                            <option value="">Foreign National</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="">&nbsp;</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="nicPassport" id="nic" value="" checked />
                                            <label for="nicNo" class="form-check-label">National ID No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="nicPassport" id="postal" value="" />
                                            <label for="degree" class="form-check-label">Postal ID No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="nicPassport" id="passport" value="" />
                                            <label for="degree" class="form-check-label">Passport No.</label>
                                        </div>
                                        <input type="text" class="form-control" id="nic" name="nic" placeholder="Choose relevent No from above and enter it here.">
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob">
                                    </div>
                                </div>
                            </div>
                            <!-- /PERSONAL DETAILS -->

                            <!-- EDUCATIONAL QUALIFICATIONS -->
                            <div class="details px-3 mt-4 pb-4">
                                <h6 class="text-left mt-4 mb-4">Educational Qualifications</h6>
                                <small style="color:slategrey;">* Choose your highest educational qualification.</small>
                                <div class="form-check px-5 mt-2">
                                    <input type="radio" class="form-check-input" name="qualification" id="degree" value="" checked />
                                    <label for="degree" class="form-check-label">Bachelor's Degree</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="qualification" id="highDip" value="" />
                                    <label for="highDip" class="form-check-label">Advanced/Higher Diploma from a nationally or internationally recognized organisation</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="qualification" id="diploma" value="" />
                                    <label for="diploma" class="form-check-label">Diploma from a nationally or internationally recognized organisation</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="qualification" id="aLevel" value="" />
                                    <label for="aLevel" class="form-check-label">GCE Advanced Level</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="qualification" id="oLevel" value="" />
                                    <label for="oLevel" class="form-check-label">GCE Ordinary Level</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="qualification" id="otherQual" value="" />
                                    <label for="otherQual" class="form-check-label">Any other qualification</label>
                                </div>
                            </div>
                            <!-- /EDUCATIONAL QUALIFICATIONS -->

                            <!-- CONTACT DETAILS -->
                            <div class="details px-3 mt-4">
                                <h6 class="text-left mt-4 mb-5">Contact Details</h6>
                                <div class="form-row align-item-center">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <h6 style="color: black;" class="mb-4">Permanent Address</h6>
                                        <div class="form-group row">
                                            <label for="house" class="col-xl-4 col-md-12 col-form-label">House Name/No:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="house" name="house">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="street1" class="col-xl-4 col-md-12 col-form-label">Street 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="street1" name="street1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="street2" class="col-xl-4 col-md-12 col-form-label">Street 2:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="street2" name="street2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city1" class="col-xl-4 col-md-12 col-form-label">City 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="city1" id="city1" class="form-control">
                                                    <option value="">Colombo</option>
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city2" class="col-xl-4 col-md-12 col-form-label">City 2:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="city2" id="city2" class="form-control">
                                                    <option value="">Colombo</option>
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-outline-primary form-control col-2 text-center" onclick="add_field();" class="addField" id="addField"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-xl-6 col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="addrs" id="addrs" onclick="">
                                            <label for="addrs" class="form-check-label" ><h6 style="color: black;" class="mb-4">Current Address (Optional)</h6></label>
                                        </div>
                                        <!--<h6 style="color: black;" class="mb-4">Current Address (Optional)</h6> -->
                                        <div class="form-group row">
                                            <label for="currentHouse" class="col-xl-4 col-md-12 col-form-label">House Name/No:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="currentHouse" name="currentHouse" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentStreet1" class="col-xl-4 col-md-12 col-form-label">Street 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="currentStreet1" name="currentStreet1" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentStreet2" class="col-xl-4 col-md-12 col-form-label">Street 2:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="currentStreet2" name="currentStreet2" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentCity1" class="col-xl-4 col-md-12 col-form-label">City 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="currentCity1" id="currentCity1" class="form-control" disabled>
                                                    <option value="">Colombo</option>
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentCity2" class="col-xl-4 col-md-12 col-form-label">City 2:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="currentCity2" id="currentCity2" class="form-control" disabled>
                                                    <option value="">Colombo</option>
                                                    <option value="">&nbsp;</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right curntAddrs">
                                            <button type="button" class="btn btn-outline-primary form-control col-2 text-center" onclick="add_field()" class="addField" id="addField" disabled><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="country">Country</label>
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Sri Lanka</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="telephone">Telephone Number</label>
                                        <input type="tel" class="form-control" id="telephone" name="telephone" >
                                    </div>

                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                            </div>
                            <!-- /CONTACT DETAILS -->
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