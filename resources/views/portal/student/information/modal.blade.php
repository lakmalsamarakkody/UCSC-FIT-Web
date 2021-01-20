{{-- PROFILE PICTURE --}}
  <div class="modal fade" id="modal-profile-picture" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Profile Picture</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="window.location.reload();">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
            <form id="profilePicForm">
              <div class="form-row">
                <div class="form-group col">
                  <label for="resultFile">Upload a new image here</label>
                  <div class="drop-zone">
                    <span class="drop-zone__prompt">Drag & Drop Image File here or click to upload</span>
                    <input type="file" name="profileImage" id="profileImage" class="drop-zone__input"/>
                  </div>
                  <span class="invalid-feedback birth" id="error-profileImage" role="alert"></span>
                </div>
              </div>
              
            </form>
            <span class="alert alert-danger d-block text-center " role="alert">Avoid upploading inappropiate images! Accounts with such images will be banned without notice.</span>
            
            <div class="float-right">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"  onclick="window.location.reload();">Discard</button>
              <button type="button" id="btnUploadProfilePic" class="btn btn-outline-primary" onclick="upload_profile_pic()">
              Upload
               <span id="spinnerprofilePic" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>
        </div>
        <div class="modal-footer d-block px-5">

          <h6>
            Or Select a previous Image</h6>
          <div class="past-img float-left">          
          @foreach(File::glob(public_path('storage/portal/avatar/'.$student->id).'/*') as $path)
          <button class="btn btn-link" onclick="select_profile_pic('{{ str_replace(public_path(), '', $path) }}')">
            <img src="{{ url('') }}{{ str_replace(public_path(), '', $path) }}" width="50px">
          </button>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- /PROFILE PICTURE --}}

{{-- EDUCATION QUALIFICATION --}}
  <div class="modal fade" id="modal-education-qualification" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Educational Qualification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
            <form id="qualificationForm">
              <div class="form-row">
                <div class="form-group col">
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
                </div>
              </div>
              
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
            <button type="button" id="btnUpdateQualification" class="btn btn-outline-primary" onclick="update_qualification()">
            Update
            <span id="spinnerQualification" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
{{-- /EDUCATION QUALIFICATION --}}

{{-- CONTACT DETAILS --}}
  <div class="modal fade" id="modal-contact-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Contact Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
            <form id="formUpdateContactDetails">
              <div class="form-row">
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
                            <select name="selectDistrict" id="selectDistrict" class="form-control" onchange="onChangeState('sriLanka');">
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
                            <select name="selectState" id="selectState" class="form-control" onchange="onChangeState('foreignState');">
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
                            <select id="country" name="country" class="form-control" onchange="onChangeCountry();">
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
                        <input type="checkbox" class="form-check-input" name="current_address" id="current_address" onclick="address_editable();" data-toggle="collapse" data-target="#collapsePlus" aria-expanded="false" aria-controls="collapsePlus" @if($student != NULL && $student->current_house!=NULL) checked @endif >
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
                        <label for="currentAddressLine2" class="col-xl-4 col-md-12 col-form-label">Address Line 2: <small>(Optional)</small></label>
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
                        <label for="currentAddressLine3" class="col-xl-4 col-md-12 col-form-label">Address Line 3: <small>(Optional)</small></label>
                        <div class="col-xl-8 col-md-12">
                            <input type="text" class="form-control @error('currentAddressLine3') is-invalid @enderror" id="currentAddressLine3" name="currentAddressLine3" @if($student != NULL) value="{{ $student->current_address_line3 }}" @endif disabled>
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
                            <input type="text" class="form-control @error('currentAddressLine4') is-invalid @enderror" id="currentAddressLine4" name="currentAddressLine4" @if($student != NULL) value="{{ $student->current_address_line4 }}" @endif disabled>
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
                            <select name="selectCurrentDistrict" id="selectCurrentDistrict" class="form-control" disabled onchange="onChangeCurrentState('sriLanka');">
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
                            <select name="selectCurrentState" id="selectCurrentState" class="form-control" disabled onchange="onChangeCurrentState('foreignState');">
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
                            <select name="currentCountry" id="currentCountry" class="form-control" disabled onchange="onChangeCurrentCountry();">
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
              
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" id="btnUpdateContactDetails" name="btnUpdateContactDetails" class="btn btn-outline-primary" onclick="update_contact_details()">
          Update
          <span id="spinnerContactDetails" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
{{-- /CONTACT DETAILS --}}