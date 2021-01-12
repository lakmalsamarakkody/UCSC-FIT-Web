@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#registration').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 student-registration min-vh-100">
        <div class="row">

            <div class="col-12 px-0">
                <div class="card">
                    <div class="card-header text-center">Register to FIT Programme<br><small style="text-transform: initial;">Please fill all the details correctly</small></div>
                    <div class="card-body">
                        <form id="registerForm" action="{{ url('/portal/student/registration/saveinfo') }}" method="POST">
                        @csrf
                            <!-- PERSONAL DETAILS -->
                            <div class="details px-3 pb-3">
                                <h6 class="text-left mt-4 mb-4">Personal Details</h6>
                                <small>* Please fill your name and birthday as appearing in the Birth Certificate.</small>
                                <div class="form-row align-item-center mt-2">
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="selectTitle">Title</label>
                                        <select name="title" id="title" class="form-control">
                                            <option disabled selected>Select your Title</option>
                                            @foreach ($student_titles as $student_title)
                                                @if ($student != NULL)
                                                    @if ($student->title == $student_title->title)
                                                        <option value="{{ $student_title->title }}" selected>{{ $student_title->title }}</option>
                                                    @else
                                                        <option value="{{ $student_title->title }}">{{ $student_title->title }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{ $student_title->title }}">{{ $student_title->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" id="error-title" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Start with Capital letter (e.g. Charith)" @if($student != NULL) value="{{ $student->first_name }}" @endif/>
                                        <span class="invalid-feedback" id="error-firstName" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="middleNames">Middle Names</label>
                                        <input type="text" class="form-control" id="middleNames" name="middleNames" placeholder="First Letters of name with Capital letter (e.g. Kumara Sampath)" @if($student != NULL) value="{{ $student->middle_names }}" @endif/>
                                        <span class="invalid-feedback" id="error-middleNames" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="lastName">Name with Initials</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend col-4 px-0">
                                                <input type="text" class="form-control" id="initials" name="initials" placeholder="e.g. CKS" @if($student != NULL) value="{{ $student->initials }}" @endif/>
                                            </div>
                                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="e.g. Wickramarachchi" @if($student != NULL) value="{{ $student->last_name }}" @endif/>
                                        </div>
                                        <span class="invalid-feedback" id="error-initials" role="alert"></span>
                                        <span class="invalid-feedback" id="error-lastName" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-12 col-md-12">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="e.g. Charith Kumara Sampath Wickramarachchi" @if($student != NULL) value="{{ $student->full_name }}" @endif/>
                                        <span class="invalid-feedback" id="error-fullName" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" @if($student != NULL) value="{{ $student->dob }}" @endif/>
                                        <span class="invalid-feedback" id="error-dob" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option disabled selected>Select your Gender</option>
                                            @if ($student != NULL && $student->gender == "Male")
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                            @elseif ($student != NULL && $student->gender == "Female")
                                                <option value="Male">Male</option>
                                                <option value="Female" selected>Female</option>
                                            @else
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" id="error-gender" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="citizenship">Citizenship</label>
                                        <select name="citizenship" id="citizenship" class="form-control" onchange="onChangeCitizenship()" data-toggle="collapse">
                                            <option selected disabled>Select your Citizenship</option>
                                            @if ($student != NULL && $student->citizenship == 'Sri Lankan')
                                                <option value="Sri Lankan" selected>Sri Lankan</option>
                                                <option value="Foreign National">Foreign National</option>
                                            @elseif ($student != NULL && $student->citizenship == 'Foreign National')
                                                <option value="Sri Lankan">Sri Lankan</option>
                                                <option value="Foreign National" selected>Foreign National</option>
                                            @else
                                                <option value="Sri Lankan">Sri Lankan</option>
                                                <option value="Foreign National">Foreign National</option>
                                            @endif
                                        </select>
                                        <span class="invalid-feedback" id="error-citizenship" role="alert"></span>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="uniqueType">&nbsp;</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="uniqueType" id="uniqueTypeNic" value="nic" checked />
                                            <label for="nicNo" class="form-check-label">National ID No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            @if($student != NULL && $student->postal)
                                                <input type="radio" class="form-check-input" name="uniqueType" id="uniqueTypePostal" value="postal" checked/>
                                            @else 
                                                <input type="radio" class="form-check-input" name="uniqueType" id="uniqueTypePostal" value="postal" />
                                            @endif
                                            <label for="postalNo" class="form-check-label">Postal ID No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            @if($student != NULL && $student->passport)
                                                <input type="radio" class="form-check-input" name="uniqueType" id="uniqueTypePassport" value="passport" checked/>
                                            @else 
                                                <input type="radio" class="form-check-input" name="uniqueType" id="uniqueTypePassport" value="passport" />
                                            @endif
                                            <label for="passportNo" class="form-check-label">Passport No.</label>
                                        </div>
                                        <input type="text" class="form-control" id="unique_id" name="unique_id" @if($student != NULL) value="@if($student->nic_old){{ $student->nic_old }} @elseif($student->nic_new){{ $student->nic_new }} @elseif($student->postal){{$student->postal}} @elseif($student->passport){{ $student->passport }} @endif" @endif placeholder="Enter your ID number here.">
                                        <span class="invalid-feedback" id="error-unique_id" role="alert"></span>
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
                                    @if($student != NULL && $student->education == 'higherdiploma')
                                        <input type="radio" class="form-check-input" name="qualification" id="higherdiploma" value="higherdiploma" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="higherdiploma" value="higherdiploma" />
                                    @endif
                                    <label for="higherdiploma" class="form-check-label">Advanced/Higher Diploma from a nationally or internationally recognized organisation</label>
                                </div>
                                <div class="form-check px-5">
                                    @if($student != NULL && $student->education == 'diploma')
                                        <input type="radio" class="form-check-input" name="qualification" id="diploma" value="diploma" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="diploma" value="diploma" />
                                    @endif
                                    <label for="diploma" class="form-check-label">Diploma from a nationally or internationally recognized organisation</label>
                                </div>
                                <div class="form-check px-5">
                                    @if($student != NULL && $student->education == 'advancedlevel')
                                        <input type="radio" class="form-check-input" name="qualification" id="advancedlevel" value="advancedlevel" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="advancedlevel" value="advancedlevel" />
                                    @endif
                                    <label for="advancedlevel" class="form-check-label">GCE Advanced Level</label>
                                </div>
                                <div class="form-check px-5">
                                    @if($student != NULL && $student->education == 'ordinarylevel')
                                        <input type="radio" class="form-check-input" name="qualification" id="ordinarylevel" value="ordinarylevel" checked/>
                                    @else
                                        <input type="radio" class="form-check-input" name="qualification" id="ordinarylevel" value="ordinarylevel" />
                                    @endif
                                    <label for="ordinarylevel" class="form-check-label">GCE Ordinary Level</label>
                                </div>
                                <div class="form-check px-5">
                                    @if($student != NULL && $student->education == 'otherqualification')
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
                                                <input type="text" class="form-control" id="house" name="house" @if($student != NULL) value="{{ $student->permanent_house }}" @endif>
                                                <span class="invalid-feedback" id="error-house" role="alert"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="addressLine1" class="col-xl-4 col-md-12 col-form-label">Address Line 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="addressLine1" name="addressLine1" @if($student != NULL) value="{{ $student->permanent_address_line1 }}" @endif>
                                                <span class="invalid-feedback" id="error-addressLine1" role="alert"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="addressLine2" class="col-xl-4 col-md-12 col-form-label">Address Line 2: <small>(Optional)</small></label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="addressLine2" name="addressLine2" @if($student != NULL) value="{{ $student->permanent_address_line2 }}" @endif>
                                                <span class="invalid-feedback" id="error-addressLine2" role="alert"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="addressLine3" class="col-xl-4 col-md-12 col-form-label">Address Line 3: <small>(Optional)</small></label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="addressLine3" name="addressLine3" @if($student != NULL) value="{{ $student->permanent_address_line3 }}" @endif>
                                                <span class="invalid-feedback" id="error-addressLine3" role="alert"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="addField">
                                            <label for="addressLine4" class="col-xl-4 col-md-12 col-form-label">Address Line 4:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="addressLine4" name="addressLine4" @if($student != NULL) value="{{ $student->permanent_address_line4 }}" @endif>
                                                <span class="invalid-feedback" id="error-addressLine4" role="alert"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="col-xl-4 col-md-12 col-form-label">City:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="city" id="city" class="form-control">
                                                    <option disabled selected>Select your city</option>
                                                    @if ($student != NULL)
                                                        @foreach ($city_list as $city)
                                                            @if($student->permanent_city_id == $city->id)
                                                                <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                            @else
                                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback" id="error-city" role="alert"></span>
                                                <small class="form-text text-muted">* Cities are shown after selecting a District/State.<br>
                                                    (If your city is not in the list, please type it in the above extra address line field)</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectDistrict">
                                            <label for="selectDistrict" class="col-xl-4 col-md-12 col-form-label">District:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectDistrict" id="selectDistrict" class="form-control" onchange="onChangeState('sriLanka')">
                                                    <option disabled selected>Select your district</option>
                                                    @if ($student != NULL)
                                                        @foreach ($states_list as $states)
                                                            @if($student->permanent_state_id == $states->id)
                                                                <option value="{{ $states->id }}" selected>{{ $states->name }}</option>
                                                            @else
                                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback" id="error-selectDistrict" role="alert"></span>
                                                <small class="form-text text-muted">* Districts are shown after selecting a Country.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectState">
                                            <label for="selectState" class="col-xl-4 col-md-12 col-form-label">State:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectState" id="selectState" class="form-control" onchange="onChangeState('foreignState')">
                                                    <option disabled selected>Select your state</option>
                                                    @if ($student != NULL)
                                                        @foreach ($states_list as $states)
                                                            @if($student->permanent_state_id == $states->id)
                                                                <option value="{{ $states->id }}" selected>{{ $states->name }}</option>
                                                            @else
                                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback" id="error-selectState" role="alert"></span>
                                                <small class="form-text text-muted">* States are shown after selecting a Country.<br>
                                                (If your state is not in the list, please type it in the above extra address line field)</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="country" class="col-xl-4 col-md-12 col-form-label">Country:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select id="country" name="country" class="form-control" onchange="onChangeCountry()">
                                                    <option disabled selected>Select your country</option>
                                                    @foreach ($countries_list as $countries)
                                                        @if ($student != NULL)
                                                            @if($student->permanent_country_id == $countries->id)
                                                                <option value="{{ $countries->id }}" selected>{{ $countries->name }}</option>
                                                            @else
                                                                <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" id="error-country" role="alert"></span>
                                                <small class="form-text text-muted">* Select country to show District/State.</small>
                                            </div>
                                        </div>
                                        <div class="text-right" id="divCollapsePlus1">
                                            <button class="btn btn-outline-primary form-control col-2 text-center" type="button" id="plusField" data-toggle="collapse" data-target="#addField" aria-expanded="false" aria-controls="addField" data-tooltip="tooltip" data-placement="bottom" title="Add extra Address Line"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-xl-6 col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="current_address" id="current_address" onclick="address_editable()" data-toggle="collapse" data-target="#collapsePlus" aria-expanded="false" aria-controls="collapsePlus" @if($student != NULL && $student->current_house!=NULL) checked @endif >
                                            <label for="current_address" class="form-check-label" ><h6 style="color: black;" class="mb-4">Current Address (Optional)</h6></label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentHouse" class="col-xl-4 col-md-12 col-form-label">House Name/No:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control" id="currentHouse" name="currentHouse" @if($student != NULL) value="{{ $student->current_house }}" @endif disabled>
                                                <span class="invalid-feedback" id="error-currentHouse" role="alert"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentAddressLine1" class="col-xl-4 col-md-12 col-form-label">Address Line 1:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <input type="text" class="form-control @error('currentAddressLine1') is-invalid @enderror" id="currentAddressLine1" name="currentAddressLine1" @if($student != NULL) value="{{ $student->current_address_line1 }}" @endif disabled>
                                                <span class="invalid-feedback" id="error-currentAddressLine1" role="alert"></span>
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
                                                <input type="text" class="form-control @error('currentAddressLine2') is-invalid @enderror" id="currentAddressLine2" name="currentAddressLine2" @if($student != NULL) value="{{$student->current_address_line2 }}" @endif disabled>
                                                <span class="invalid-feedback" id="error-currentAddressLine2" role="alert"></span>
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
                                                <input type="text" class="form-control @error('currentAddressLine3') is-invalid @enderror" id="currentAddressLine3" name="currentAddressLine3" @if($student != NULL) value="{{ $student->currentAddressLine3 }}" @endif disabled>
                                                <span class="invalid-feedback" id="error-currentAddressLine3" role="alert"></span>
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
                                                <input type="text" class="form-control @error('currentAddressLine4') is-invalid @enderror" id="currentAddressLine4" name="currentAddressLine4" @if($student != NULL) value="{{ $student->currentAddressLine4 }}" @endif disabled>
                                                <span class="invalid-feedback" id="error-currentAddressLine4" role="alert"></span>
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
                                                <select id="currentCity" name="currentCity" class="form-control" disabled>
                                                    <option selected disabled>Select your city</option>
                                                    @if ($student != NULL)
                                                        @foreach ($current_city_list as $city)
                                                            @if($student->current_city_id == $city->id)
                                                                <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                                            @else
                                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback" id="error-currentCity" role="alert"></span>
                                                <small class="form-text text-muted">* Cities are shown after selecting a District/State.<br>
                                                (If your city is not in the list, please type it in the above extra address line field)</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectCurrentDistrict">
                                            <label for="selectCurrentDistrict" class="col-xl-4 col-md-12 col-form-label">District:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectCurrentDistrict" id="selectCurrentDistrict" class="form-control" disabled onchange="onChangeCurrentState('sriLanka')">
                                                    <option selected disabled>Select your district</option>
                                                    @if ($student != NULL)
                                                        @foreach ($current_states_list as $states)
                                                            @if($student->current_state_id == $states->id)
                                                                <option value="{{ $states->id }}" selected>{{ $states->name }}</option>
                                                            @else
                                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback" id="error-selectCurrentDistrict" role="alert"></span>
                                                <small class="form-text text-muted">* Districts are shown after selecting a Country.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row collapse" id="divSelectCurrentState">
                                            <label for="selectCurrentState" class="col-xl-4 col-md-12 col-form-label">State:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="selectCurrentState" id="selectCurrentState" class="form-control" disabled onchange="onChangeCurrentState('foreignState')">
                                                    <option selected disabled>Select your state</option>
                                                    @if ($student != NULL)
                                                        @foreach ($current_states_list as $states)
                                                            @if($student->current_state_id == $states->id)
                                                                <option value="{{ $states->id }}" selected>{{ $states->name }}</option>
                                                            @else
                                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback" id="error-selectCurrentState" role="alert"></span>
                                                <small class="form-text text-muted">* States are shown after selecting a Country.<br>
                                                (If your state is not in the list, please type it in the above extra address line field)</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="currentCountry" class="col-xl-4 col-md-12 col-form-label">Country:</label>
                                            <div class="col-xl-8 col-md-12">
                                                <select name="currentCountry" id="currentCountry" class="form-control" disabled onchange="onChangeCurrentCountry()">
                                                    <option disabled selected>Select your country</option>
                                                    @foreach ($countries_list as $countries)
                                                        @if ($student != NULL)
                                                            @if($student->current_country_id == $countries->id)
                                                                <option value="{{ $countries->id }}" selected>{{ $countries->name }}</option>
                                                            @else
                                                                <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" id="error-currentCountry" role="alert"></span>
                                                <small class="form-text text-muted">* Select country to show District/State.</small>
                                            </div>
                                        </div>
                                        <div class="text-right collapse" id="divCollapsePlus2">
                                            <button class="btn btn-outline-primary form-control col-2 text-center" type="button" id="plusCurrentField" data-toggle="collapse" data-target="#addCurrentField" aria-expanded="false" aria-controls="addCurrentField" data-tooltip="tooltip" data-placement="bottom" title="Add extra Address Line" disabled><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="telephone">Telephone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend col-4 px-0">
                                                <select name="telephoneCountryCode" id="telephoneCountryCode" class="form-control countryCodeSelect">
                                                    <option disabled selected>Code</option>
                                                    @foreach ($countries_list as $countries)
                                                        @if($student != NULL)
                                                            @if($student->telephone_country_code == $countries->callingcode && $countries->callingcode != NULL )
                                                            <option class="countryCodeOption" value="{{ $countries->callingcode }}" selected>{{ $countries->code }} (+{{ $countries->callingcode }})</option>
                                                            @else
                                                                <option class="countryCodeOption" value="{{ $countries->callingcode }}">{{ $countries->code }} (+{{ $countries->callingcode }})</option>
                                                            @endif
                                                        @else
                                                        <option class="countryCodeOption" value="{{ $countries->callingcode }}">{{ $countries->code }} (+{{ $countries->callingcode }})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="tel" class="form-control" id="telephone" name="telephone" @if($student != NULL) value="{{ $student->telephone }}" @endif placeholder="Number without leading zeros"/>
                                          </div>
                                        <span class="invalid-feedback" id="error-telephone" role="alert"></span>
                                    </div>

                                    <div class="form-group col-xl-6 col-md-12">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="stu_email" name="stu_email" value="{{ Auth::user()->email }}" disabled>
                                        <small>* Filled with your user email. You can change it after you registered.</small>
                                        <span class="invalid-feedback" id="error-email" role="alert"></span>
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
                                    <input type="radio" class="form-check-input" name="employement" id="employement" value="yes" onclick="edit_designation()" @if($student != NULL) @if($student->designation != NULL) checked @endif @endif/>
                                    <label for="empYes" class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check px-5">
                                    <input type="radio" class="form-check-input" name="employement" id="noemployement" value="no" onclick="edit_designation()" @if($student == NULL) checked @else @if($student->designation == NULL) checked @endif @endif/>
                                    <label for="empNo" class="form-check-label">No</label>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="designation" style="color: black; font-weight: bold;" class="col-xl-12 col-md-12 col-form-label">Designation:</label>
                                    <div class="col-xl-6 col-md-12">
                                      <input type="text" class="form-control" id="designation" name="designation" @if($student != NULL) value="{{ $student->designation }}" @endif placeholder="Please enter your designation" @if($student == NULL) disabled @elseif($student->designation == NULL) disabled @endif>
                                      <span class="invalid-feedback" id="error-designation" role="alert"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /EMPLOYMENT DETAILS -->
                            <div class="row justify-content-end">

                                <div class="mt-3 col-xl-3 col-md-6 order-sm-1 order-3 @if($student != NULL && $student->flag->info_complete==1) d-none @endif " id="divResetForm">
                                    <button type="button" class="btn btn-outline-warning form-control" id="btnResetForm" onclick="reset_form()">Reset Form</button>
                                </div>
                                <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2  @if($student != NULL && $student->flag->info_complete==1) d-none @endif " id="divSaveInformation">
                                    <button type="button" class="btn btn-outline-secondary form-control" id="btnSaveInformation" role="button" aria-expanded="false" aria-controls="declaration" onclick="save_information()">Save information</button>
                                </div>
                                <div class="mt-3 col-xl-3 col-md-6 order-sm-3 order-1  @if($student != NULL && $student->flag->info_complete==0) d-none @endif " id="divEditInformation">
                                    <button type="button" class="btn btn-outline-warning form-control" id="btnEditInformation" onclick="edit_information()">Edit Information</button>
                                </div>

                            </div>
                            
                        </form>

                        <!-- INFO NOT COMPLETED ALERT -->
                        <div class="px-3 my-4 alert alert-danger border-danger d-none collapse" id="infoCompleteAlert">
                            <h6 class="text-left text-danger">Application is not completed</h6>
                            <p>Following fields must be completed to continue and submit the application.</p>
                            <div id="toBeCompletedErrors">

                            </div>
                        </div>
                        <!-- /INFO NOT COMPLETED ALERT -->

                        <!-- DECLARATION -->
                        <div class="details px-3 mt-4 pb-3 collapse @if($student != NULL && $student->flag->info_complete==1) show @endif " id="declaration">
                            <h6 class="my-4">Declaration</h6>
                            <p style="font-weight: bold;">I do hereby certify that the above particulars furnished by me are true and correct. In the event of my application for registration being accepted, I shall abide by all the regulations governing candidates of the University of Colombo School of Computing. (UCSC) I agree that the University has the right to cancel my registration at any time, either if I am found to have furnished false information or if I do not abide by the regulations governing candidates of the University of Colombo School of Computing.</p>
                            <div class="form-check text-center">
                                <input type="checkbox" class="form-check-input" id="accept" onclick="accept_conditions()" data-toggle="collapse" data-target="#divSubmitButton" aria-expanded="false" aria-controls="divSubmitButton">
                                <span class="invalid-feedback" id="error-accept" role="alert"></span>
                                <label for="accept" class="form-check-label" ><h6 style="color: var(--color-success);" class="mb-4">Accept and Continue</h6></label>
                            </div>
                        </div>
                        <!-- /DECLARATION -->

                        <!-- SUBMIT APPLICATION-->
                        <div class="row justify-content-end">
                            <div class="collapse mt-3 col-xl-3 col-md-12" id="divSubmitButton">
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