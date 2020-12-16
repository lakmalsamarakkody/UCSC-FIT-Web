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

                                        
                                            {{-- {{ $countries_list }} <br/> --}}
                                        
                                        

    <!-- CONTENT -->
    <div class="col-lg-12 student-registration">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header text-center">Register to FIT Programme<br><small style="text-transform: initial;">Please fill all the details correctly</small></div>
                    <div class="card-body">
                        <form id="registerForm" action="{{ url('/portal/student/registration') }}" method="POST">
                        @csrf
                            <!-- PERSONAL DETAILS -->
                            <div class="details px-3 pb-3">
                                <h6 class="text-left mt-4 mb-4">Personal Details</h6>
                                <small>* Please fill your name and birthday as appearing in the Birth Certificate.</small>
                                <div class="form-row align-item-center mt-2">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="selectTitle">Title</label>
                                        <select name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                            <option disabled selected>Select your Title</option>
                                            @foreach ($student_titles as $student_title)
                                                @if (old('title') == $student_title->title)
                                                    <option value="{{ $student_title->title }}" selected>{{ $student_title->title }}</option>
                                                @else
                                                    <option value="{{ $student_title->title }}">{{ $student_title->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName" placeholder="e.g. Charith" value="{{ old('firstName') }}"/>
                                        @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="middleNames">Middle Names</label>
                                        <input type="text" class="form-control @error('middleNames') is-invalid @enderror" id="middleNames" name="middleNames" placeholder="e.g. Kumara Sampath" value="{{ old('middleNames') }}" />
                                        @error('middleNames')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" placeholder="e.g. Wickramarachchi" value="{{ old('lastName') }}" />
                                        @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control @error('fullName') is-invalid @enderror" id="fullName" name="fullName" placeholder="e.g. Charith Kumara Sampath Wickramarachchi" value="{{ old('fullName') }}" />
                                        @error('fullName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="nameInitials">Name with Initials</label>
                                        <input type="text" class="form-control @error('nameInitials') is-invalid @enderror" id="nameInitials" name="nameInitials" placeholder="C K S Wickramarachchi" value="{{ old('nameInitials') }}" />
                                        @error('nameInitials')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') }}" />
                                        @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option disabled selected>Select your Gender</option>
                                            @if (old('gender') == "Male")
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                            @elseif (old('gender') == "Female")
                                                <option value="Male">Male</option>
                                                <option value="Female" selected>Female</option>
                                            @else
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            @endif
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="citizenship">Citizenship</label>
                                        <select name="citizenship" id="citizenship" class="form-control @error('citizenship') is-invalid @enderror" onchange="select_district_state()" data-toggle="collapse">
                                            <option selected disabled>Select your Citizenship</option>
                                            @if (old('citizenship') == 'Sri Lankan')
                                                <option value="Sri Lankan" selected>Sri Lankan</option>
                                                <option value="Foreign National">Foreign National</option>
                                            @elseif (old('citizenship') == 'Foreign National')
                                                <option value="Sri Lankan">Sri Lankan</option>
                                                <option value="Foreign National" selected>Foreign National</option>
                                            @else
                                                <option value="Sri Lankan">Sri Lankan</option>
                                                <option value="Foreign National">Foreign National</option>
                                            @endif
                                        </select>
                                        @error('citizenship')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="nicPassport">&nbsp;</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="nicPassport" id="nic" value="nic" checked />
                                            <label for="nicNo" class="form-check-label">National ID No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            @if(old('nicPassport') == 'postal')
                                                <input type="radio" class="form-check-input" name="nicPassport" id="postal" value="postal" checked/>
                                            @else 
                                                <input type="radio" class="form-check-input" name="nicPassport" id="postal" value="postal" />
                                            @endif
                                            <label for="postalNo" class="form-check-label">Postal ID No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            @if(old('nicPassport') == 'passport')
                                                <input type="radio" class="form-check-input" name="nicPassport" id="passport" value="passport" checked/>
                                            @else 
                                                <input type="radio" class="form-check-input" name="nicPassport" id="passport" value="passport" />
                                            @endif
                                            <label for="passportNo" class="form-check-label">Passport No.</label>
                                        </div>
                                        <input type="text" class="form-control @error('unique_id') is-invalid @enderror" id="unique_id" name="unique_id" value="{{ old('unique_id') }}" placeholder="Choose relevent No from above and enter it here.">
                                        @error('unique_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /PERSONAL DETAILS -->

                            <!-- EDUCATIONAL QUALIFICATIONS -->
                            <div class="details px-3 mt-4 pb-4">
                                <h6 class="text-left mt-4 mb-4">Educational Qualifications</h6>
                                <small>* Choose your highest educational qualification.</small>
                                <div class="form-check px-5 mt-2">
                                    <input type="radio" class="form-check-input" name="qualification" id="degree" value="degree" checked/>
                                    <label for="degree" class="form-check-label">Bachelor's Degree</label>
                                </div>
                                <div class="form-check px-5">
                                    @if(old('qualification') == 'higherdiploma')
                                        <input type="radio" class="form-check-input" name="qualification" id="higherdiploma" value="higherdiploma" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="higherdiploma" value="higherdiploma" />
                                    @endif
                                    <label for="higherdiploma" class="form-check-label">Advanced/Higher Diploma from a nationally or internationally recognized organisation</label>
                                </div>
                                <div class="form-check px-5">
                                    @if(old('qualification') == 'diploma')
                                        <input type="radio" class="form-check-input" name="qualification" id="diploma" value="diploma" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="diploma" value="diploma" />
                                    @endif
                                    <label for="diploma" class="form-check-label">Diploma from a nationally or internationally recognized organisation</label>
                                </div>
                                <div class="form-check px-5">
                                    @if(old('qualification') == 'advancedlevel')
                                        <input type="radio" class="form-check-input" name="qualification" id="advancedlevel" value="advancedlevel" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="advancedlevel" value="advancedlevel" />
                                    @endif
                                    <label for="advancedlevel" class="form-check-label">GCE Advanced Level</label>
                                </div>
                                <div class="form-check px-5">
                                    @if(old('qualification') == 'ordinarylevel')
                                        <input type="radio" class="form-check-input" name="qualification" id="ordinarylevel" value="ordinarylevel" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="ordinarylevel" value="ordinarylevel" />
                                    @endif
                                    <label for="ordinarylevel" class="form-check-label">GCE Ordinary Level</label>
                                </div>
                                <div class="form-check px-5">
                                    @if(old('qualification') == 'otherqualification')
                                        <input type="radio" class="form-check-input" name="qualification" id="otherqualification" value="otherqualification" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="otherqualification" value="otherqualification"/>
                                    @endif
                                    <label for="otherqualification" class="form-check-label">Any other qualification</label>
                                </div>
                            </div>
                            <!-- /EDUCATIONAL QUALIFICATIONS -->

                            <!-- CONTACT DETAILS -->
                            <div class="details px-3 mt-4 pb-3">
                                <h6 class="text-left mt-4 mb-4">Contact Details</h6>
                                <small>* If your current address is not the Permanent Address please click on 'Current Address (Optional)' to enter your current address.</small>
                                <div class="form-row align-item-center mt-3">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <h6 style="color: black;" class="mb-4">Permanent Address</h6>
                                        <div class="form-group row">
                                            <label for="house" class="col-xl-4 col-md-12 col-form-label">House Name/No:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('house') is-invalid @enderror" id="house" name="house" value="{{ old('house') }}">
                                                @error('house')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="addressLine1" class="col-xl-4 col-md-12 col-form-label">Address Line 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('addressLine1') is-invalid @enderror" id="addressLine1" name="addressLine1" value="{{ old('addressLine1') }}">
                                                @error('addressLine1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="addressLine2" class="col-xl-4 col-md-12 col-form-label">Address Line 2:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('addressLine2') is-invalid @enderror" id="addressLine2" name="addressLine2" value="{{ old('addressLine2') }}">
                                                @error('addressLine2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="addressLine3" class="col-xl-4 col-md-12 col-form-label">Address Line 3:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('addressLine3') is-invalid @enderror" id="addressLine3" name="addressLine3" value="{{ old('addressLine3') }}">
                                                @error('addressLine3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="addField">
                                            <label for="addressLine4" class="col-xl-4 col-md-12 col-form-label">Address Line 4:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('addressLine4') is-invalid @enderror" id="addressLine4" name="addressLine4" value="{{ old('addressLine4') }}">
                                                @error('addressLine4')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="col-xl-4 col-md-12 col-form-label">City:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="city" id="city" class="form-control">
                                                    <option disabled selected>Select your city</option>
                                                </select>
                                                <small class="form-text text-muted">* cities are shown after selecting a State/District.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectDistrict">
                                            <label for="selectDistrict" class="col-xl-4 col-md-12 col-form-label">District:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectDistrict" id="selectDistrict" class="form-control" onchange="">
                                                    <option disabled selected>Select your district</option>
                                                </select>
                                                <small class="form-text text-muted">* Districts are shown after selecting a country.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectState">
                                            <label for="selectState" class="col-xl-4 col-md-12 col-form-label">State:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectState" id="selectState" class="form-control" onchange="">
                                                    <option disabled selected>Select your state</option>
                                                </select>
                                                <small class="form-text text-muted">* States are shown after selecting a country.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="country" class="col-xl-4 col-md-12 col-form-label">Country:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select id="country" class="form-control" onchange="">
                                                    <option disabled selected>Select your country</option>
                                                    @foreach ($countries_list as $countries)
                                                        <option value="{{ $countries->id }}">{{ $countries->name }}</option><br/>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right" id="divCollapsePlus1">
                                            <button class="btn btn-outline-primary form-control col-2 text-center" type="button" id="plusField" data-toggle="collapse" data-target="#addField" aria-expanded="false" aria-controls="addField" data-tooltip="tooltip" data-placement="bottom" title="Add extra Address Line"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-xl-6 col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="addrs" id="current_address" onclick="address_editable()" data-toggle="collapse" data-target="#collapsePlus" aria-expanded="false" aria-controls="collapsePlus" >
                                            <label for="current_address" class="form-check-label" ><h6 style="color: black;" class="mb-4">Current Address (Optional)</h6></label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentHouse" class="col-xl-4 col-md-12 col-form-label">House Name/No:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('currentHouse') is-invalid @enderror" id="currentHouse" name="currentHouse" value="{{ old('currentHouse') }}" disabled>
                                                @error('currentHouse')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentAddressLine1" class="col-xl-4 col-md-12 col-form-label">Address Line 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('currentAddressLine1') is-invalid @enderror" id="currentAddressLine1" name="currentAddressLine1" value="{{ old('currentAddressLine1') }}" disabled>
                                                @error('currentAddressLine1')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentAddressLine2" class="col-xl-4 col-md-12 col-form-label">Address Line 2:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('currentAddressLine2') is-invalid @enderror" id="currentAddressLine2" name="currentAddressLine2" value="{{ old('currentAddressLine2') }}" disabled>
                                                @error('currentAddressLine2')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentAddressLine3" class="col-xl-4 col-md-12 col-form-label">Address Line 3:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('currentAddressLine3') is-invalid @enderror" id="currentAddressLine3" name="currentAddressLine3" value="{{ old('currentAddressLine3') }}" disabled>
                                                @error('currentAddressLine3')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="addCurrentField">
                                            <label for="currentAddressLine4" class="col-xl-4 col-md-12 col-form-label">Address Line 4:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('currentAddressLine4') is-invalid @enderror" id="currentAddressLine4" name="currentAddressLine4" value="{{ old('currentAddressLine4') }}" disabled>
                                                @error('currentAddressLine4')
                                                  <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentCity" class="col-xl-4 col-md-12 col-form-label">City:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select id="currentCity" class="form-control" disabled>
                                                    <option>City 1</option>
                                                    <option>&nbsp;</option>
                                                </select>
                                                <small class="form-text text-muted">* Cities are shown after selecting a State/District.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectCurrentDistrict">
                                            <label for="selectCurrentDistrict" class="col-xl-4 col-md-12 col-form-label">District:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectCurrentDistrict" id="selectCurrentDistrict" class="form-control" disabled onchange="">
                                                    <option>Colombo</option>
                                                    <option>&nbsp;</option>
                                                </select>
                                                <small class="form-text text-muted">* Districts are shown after selecting a country.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectCurrentState">
                                            <label for="selectCurrentState" class="col-xl-4 col-md-12 col-form-label">State:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectCurrentState" id="selectCurrentState" class="form-control" disabled onchange="">
                                                    <option>State 1</option>
                                                    <option>&nbsp;</option>
                                                </select>
                                                <small class="form-text text-muted">* States are shown after selecting a country.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentCountry" class="col-xl-4 col-md-12 col-form-label">Country:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select id="currentCountry" class="form-control" disabled onchange="">
                                                    <option disabled selected>Select your country</option>
                                                    @foreach ($countries_list as $countries)
                                                        <option value="{{ $countries->id }}">{{ $countries->name }}</option><br/>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right" id="divCollapsePlus2">
                                            <button class="btn btn-outline-primary form-control col-2 text-center" type="button" id="plusCurrentField" data-toggle="collapse" data-target="#addCurrentField" aria-expanded="false" aria-controls="addCurrentField" data-tooltip="tooltip" data-placement="bottom" title="Add extra Address Line" disabled><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="telephone">Telephone Number</label>
                                        <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" >
                                        @error('telephone')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" disabled>
                                        <small>* Filled with your given email. You can change it after you registered.</small>
                                        @error('email')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /CONTACT DETAILS -->

                            <!-- EMPLOYMENT DETAILS -->
                            <div class="details px-3 mt-4 pb-3">
                                <h6 class="text-left mt-4 mb-4">Employment Details</h6>
                                <small>* Please note that employment details would be kept confidential and will be utilized only for purposed of improving the FIT programme.</small>
                                <h6 style="color: black;" class="mt-3 mb-3">Are you currently employed ?</h6>
                                <div class="form-check px-5 mt-2">
                                    <input type="radio" class="form-check-input" name="employement" id="empYes" value="yes" onclick="edit_designation()"/>
                                    <label for="empYes" class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="employement" id="empNo" value="no" onclick="edit_designation()" checked/>
                                    <label for="empNo" class="form-check-label">No</label>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="designation" style="color: black; font-weight: bold;" class="col-xl-12 col-md-12 col-form-label">Designation:</label>
                                    <div class="col-xl-6 col-md-12">
                                      <input type="text" class="form-control  @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation') }}" placeholder="Please enter your designation" disabled>
                                      @error('designation')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /EMPLOYMENT DETAILS -->
                            <div class="row justify-content-end">

                                <div class="mt-3 col-xl-3 col-md-6 order-sm-1 order-3" id="divResetForm">
                                    <button type="button" class="btn btn-outline-warning form-control" id="btnResetForm" onclick="reset_form()">Reset Form</button>
                                </div>
                                <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveInformation">
                                    <button type="submit" class="btn btn-outline-secondary form-control" id="btnSaveInformation" role="button" aria-expanded="false" aria-controls="declaration">Save information</button>
                                </div>
                                <div class="mt-3 col-xl-3 col-md-6 order-sm-3 order-1 d-none" id="divEditInformation">
                                    <button type="button" class="btn btn-outline-warning form-control" id="btnEditInformation" onclick="edit_information()">Edit Information</button>
                                </div>

                            </div>
                            
                        </form>


                            <!-- DECLARATION -->
                            <div class="details px-3 mt-4 pb-3 collapse" id="declaration">
                                <h6 class="text-left mt-4 mb-4">Declaration</h6>
                                <p style="font-weight: bold;">I do hereby certify that the above particulars furnished by me are true and correct. In the event of my application for registration being accepted, I shall abide by all the regulations governing candidates of the University of Colombo School of Computing. (UCSC) I agree that the University has the right to cancel my registration at any time, either if I am found to have furnished false information or if I do not abide by the regulations governing candidates of the University of Colombo School of Computing.</p>
                                <div class="form-check text-center">
                                    <input type="checkbox" class="form-check-input" id="accept" onclick="accept_conditions()" data-toggle="collapse" data-target="#divSubmitButton" aria-expanded="false" aria-controls="divSubmitButton">
                                    <label for="accept" class="form-check-label" ><h6 style="color: var(--color-success);" class="mb-4">Accept and Continue</h6></label>
                                </div>
                            </div>
                            <!-- /DECLARATION -->

                            <!-- SUBMIT APPLICATION-->
                            <div class="row justify-content-end">
                                <div class="collapse mt-3 col-xl-3 col-md-6" id="divSubmitButton">
                                    <button type="button" class="btn btn-outline-primary form-control" id="btnSubmitApplication" onclick="submit_application()" disabled>Submit Application</button>
                                </div>
                            </div>
                            
                            <!-- SUBMIT APPLICATION-->


                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- /CONTENT -->    
@endsection

@section('script')
  @include('portal.student.registration.scripts')
@endsection