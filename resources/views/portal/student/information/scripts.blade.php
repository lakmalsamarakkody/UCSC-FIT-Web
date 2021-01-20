<script type="text/javascript">

$(document).ready(function(){
  address_editable();
  setViewDistrictState();
})
  // EMAIL
  reset_email = () => {
    SwalQuestionSuccess.fire({
      input: 'email',
      inputLabel: 'Enter New Student E-mail',
      inputPlaceholder: 'Email',
      title: "Are you sure ?",
      text: "Verification email will be sent",
      confirmButtonText: "Yes, Send!",
    })
    .then((result) => {
      event.preventDefault();
      // alert(result.value);
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('update.email') }}",
          type: 'post',
          data: { 'email': result.value},         
          beforeSend: function(){
            // Show loader
            $('body').addClass('freeze');
            Swal.showLoading();
          },
          success: function(data){
            $('body').removeClass('freeze');
            Swal.hideLoading();
            if(data['errors']){
              $.each(data['errors'], function(key, value){
                SwalNotificationErrorDanger.fire({
                  title: 'Error!',
                  text: value
                })
                // alert(value)
              });
            }else if (data['success']){
              SwalDoneSuccess.fire({
                title: 'Verify Email!',
                text: 'Email Verification is emailed to ',
              }).then((result) => {
                if(result.isConfirmed) {
                  location.reload()
                }
              });
            }else if (data['error']){
              SwalSystemErrorDanger.fire({
                title: 'Update Failed!',
                text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
              })
            }
          },
          error: function(err){
            $('body').removeClass('freeze');
            Swal.hideLoading();
            SwalErrorDanger.fire({
              title: 'Update Failed!',
              text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
            })
          }
        });

      
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Verification email not sent",
        })
      }
    })
  }
  // /EMAIL

  // UPDATE PROFILE PIC
  upload_profile_pic = () => {
    
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();


    // FORM PAYLOAD
    var formData = new FormData($("#profilePicForm")[0]);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('upload.profile.pic') }}",
      type: 'post',
      data: formData,  
      processData: false,
      contentType: false,         
      beforeSend: function(){
        // Show loader
        $("#spinnerprofilePic").removeClass('d-none');
        $('#btnUploadProfilePic').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinnerprofilePic").addClass('d-none');
        $('#btnUploadProfilePic').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>');
            window.location.hash = '#'+key;
          });
        }else if (data['success']){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'Succesfully Uploaded!',
            text: 'Profile picture updated succefully',
          }).then((result) => {
            if(result.isConfirmed) {
              location.reload()
            }
          });
        }else if (data['error']){
          SwalSystemErrorDanger.fire({
            title: 'Upload Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinnerprofilePic").addClass('d-none');
        $('#btnUploadProfilePic').removeAttr('disabled');
        SwalErrorDanger.fire({
          title: 'Upload Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPDATE PROFILE PIC

  // SELECT PROFILE PIC
  select_profile_pic = (path) => {
    
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('select.profile.pic') }}",
      type: 'post',
      data: {
          'path':path
      },          
      beforeSend: function(){
        // Show loader
        $("#spinnerprofilePic").removeClass('d-none');
        $('#btnUploadProfilePic').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinnerprofilePic").addClass('d-none');
        $('#btnUploadProfilePic').removeAttr('disabled');
        if (data['success']){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'Succesfully Uploaded!',
            text: 'Profile picture updated succefully',
          }).then((result) => {
            if(result.isConfirmed) {
              location.reload()
            }
          });
        }else if (data['error']){
          SwalSystemErrorDanger.fire({
            title: 'Upload Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinnerprofilePic").addClass('d-none');
        $('#btnUploadProfilePic').removeAttr('disabled');
        SwalErrorDanger.fire({
          title: 'Upload Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /SELECT PROFILE PIC

  // UPDATE QUALIFICATION
  update_qualification = () => {
    
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();


    // FORM PAYLOAD
    var formData = new FormData($("#qualificationForm")[0]);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('update.qualification') }}",
      type: 'post',
      data: formData,  
      processData: false,
      contentType: false,         
      beforeSend: function(){
        // Show loader
        $("#spinnerQualification").removeClass('d-none');
        $('#btnUpdateQualification').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinnerQualification").addClass('d-none');
        $('#btnUpdateQualification').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>');
            window.location.hash = '#'+key;
          });
        }else if (data['success']){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'Succesfully Updated!',
            text: 'Educational Qualification updated succefully',
          }).then((result) => {
            if(result.isConfirmed) {
              location.reload()
            }
          });
        }else if (data['error']){
          SwalSystemErrorDanger.fire({
            title: 'Update Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinnerQualification").addClass('d-none');
        $('#btnUpdateQualification').removeAttr('disabled');
        SwalErrorDanger.fire({
          title: 'Update Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPDATE QUALIFICATION

  // DISPLAY DISTRICT OR STATE ACCORDING TO COUNTRY
  setViewDistrictState = () => {
    //Permanent address district/state
    if($('#country').val() == '67') {
      $('#divSelectState').collapse('hide');
      $('#divSelectDistrict').collapse('show');
    }
    else if($('#country').val() != '67' && $('#country').val() != null) {
      $('#divSelectDistrict').collapse('hide');
      $('#divSelectState').collapse('show');
    }
    else {
      $('#divSelectDistrict').collapse('hide');
      $('#divSelectState').collapse('hide');
    }

    // Current address district/state
    if($('#currentCountry').val() == '67') {
      $('#divSelectCurrentState').attr('disabled', 'disabled');
      $('#divSelectCurrentState').collapse('hide');
      $('#divSelectCurrentDistrict').removeAttr('disabled', 'disabled');
      $('#divSelectCurrentDistrict').collapse('show');
    }
    else if($('#currentCountry').val() != '67' && $('#currentCountry').val() != null) {
      $('#divSelectCurrentDistrict').attr('disabled', 'disabled');
      $('#divSelectCurrentDistrict').collapse('hide');
      $('#divSelectCurrentState').removeAttr('disabled', 'disabled');
      $('#divSelectCurrentState').collapse('show');
    }
    else {
      $('#divSelectCurrentDistrict').attr('disabled', 'disabled');
      $('#divSelectCurrentDistrict').collapse('hide');
      $('#divSelectCurrentState').attr('disabled', 'disabled');
      $('#divSelectCurrentState').collapse('hide');
    }
  }
  // /DISPLAY DISTRICT OR STATE ACCORDING TO COUNTRY

  // Insert current address
  address_editable = () => {
    console.log('address editable invoked');
    if($('#current_address').prop("checked")) {
      console.log('current address enabled');
      $('#currentHouse').removeAttr('disabled');
      $('#currentAddressLine1').removeAttr('disabled');
      $('#currentAddressLine2').removeAttr('disabled');
      $('#currentAddressLine3').removeAttr('disabled');
      $('#currentAddressLine4').removeAttr('disabled');
      $('#currentCity').removeAttr('disabled');
      $('#currentCountry').removeAttr('disabled');
      $('#divCollapsePlus2').collapse('show');
      $('#plusCurrentField').removeAttr('disabled');
      $('#selectCurrentDistrict').removeAttr('disabled');
      $('#selectCurrentState').removeAttr('disabled');
    }
    else{
      console.log('current address disabled');
      $('#currentHouse').attr('disabled','disabled');
      $('#currentAddressLine1').attr('disabled','disabled');
      $('#currentAddressLine2').attr('disabled','disabled');
      $('#currentAddressLine3').attr('disabled','disabled');
      $('#currentAddressLine4').attr('disabled','disabled');
      $('#currentCity').attr('disabled','disabled');
      $('#currentCountry').attr('disabled','disabled');
      $('#plusCurrentField').attr('disabled','disabled');
      $('#divCollapsePlus2').collapse('hide');
      $('#selectCurrentDistrict').attr('disabled','disabled');
      $('#selectCurrentState').attr('disabled','disabled');
    }
  }
  // /Insert current address

  // ONCHANGE Country GET District/States
  onChangeCountry = () => {

    //SET DISTRICT OR STATE VIEW 
    if($('#country').val() == '67') {
      // set visible selects
      $('#divSelectDistrict').collapse('show');
      $('#divSelectState').collapse('hide');
    }
    else if($('#country').val() != '67') {
      $('#divSelectDistrict').collapse('hide')
      $('#divSelectState').collapse('show')
    }
    // FORM PAYLOAD
    var formData = new FormData();
    // ADD DATA
    formData.append('country', $('#country').val())

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/information/update/get-states') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        console.log('success');
        if(data['status'] == 'error'){
          SwalNotificationErrorDanger.fire({title: 'Error!',text: $.each(data['errors'], function(key, value){value}),
          });
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#selectState').find('option').remove().end().append('<option selected disabled>Select your state</option>')
          $('#selectDistrict').find('option').remove().end().append('<option selected disabled>Select your district</option>')
          $('#city').find('option').remove().end().append('<option selected disabled>Select your city</option>')
          // APPEND COUNTRY LIST
          if(data['state_type'] == 'districts'){
            $.each(data['state_list'], function(key,value){
              $('#selectDistrict').append($('<option>', { value: value.id,text : value.name}));
            })
          }
          else if(data['state_type'] == 'divisions'){
            $.each(data['state_list'], function(key,value){
              $('#selectState').append($('<option>', { value: value.id,text : value.name}));
            })
            $.each(data['city_list'], function(key,value){
              $('#city').append($('<option>', { value: value.id,text : value.name}));
            })
          }
        }
      },
      error: function(err){
        console.log('error');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /ONCHANGE Country GET District/States

  // ONCHANGE Current Country GET Current District/States
  onChangeCurrentCountry = () => {

    // FORM PAYLOAD
    var formData =  new FormData();
    // ADD DATA
    formData.append('currentCountry', $('#currentCountry').val())

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/information/update/get-states') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        console.log('success');
        if(data['status'] == 'error'){
          SwalNotificationErrorDanger.fire({title: 'Error!', text: $.each(data['errors'], function(key, value){value}),
          });
        }
        else if (data['status'] == 'success'){
          //CLEAR CURRENT LIST
          $('#selectCurrentState').find('option').remove().end().append('<option selected disabled>Select your state</option>')
          $('#selectCurrentDistrict').find('option').remove().end().append('<option selected disabled>Select your district</option>')
          $('#currentCity').find('option').remove().end().append('<option selected disabled>Select your city</option>')
          //APPEND COUNTRY LIST
          if(data['state_type'] == 'districts'){
            $('#selectCurrentState').attr('disabled', 'disabled');
            $('#divSelectCurrentState').collapse('hide');
            $('#divSelectCurrentDistrict').collapse('show');
            $('#selectCurrentDistrict').removeAttr('disabled', 'disabled');
            $.each(data['state_list'], function(key,value){
              $('#selectCurrentDistrict').append($('<option>',{value: value.id,text: value.name}));
            })
          }
          else if(data['state_type'] == 'divisions'){
            $('#selectCurrentDistrict').attr('disabled', 'disabled');
            $('#divSelectCurrentDistrict').collapse('hide');
            $('#divSelectCurrentState').collapse('show');
            $('#selectCurrentState').removeAttr('disabled', 'disabled');
            $.each(data['state_list'], function(key,value){
              $('#selectCurrentState').append($('<option>', {value: value.id,text: value.name}));
            })
            $.each(data['city_list'], function(key,value){
              $('#currentCity').append($('<option>', {value: value.id,text: value.name}));
            })
          }
        }
      },
      error: function(err){
        console.log('error');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /ONCHANGE Country GET Current District/States

  // ONCHANGE State GET Cities
  onChangeState = (stateType) => {
    // FORM PAYLOAD
    var formData = new FormData();
    // ADD DATA
    formData.append('stateType', stateType);
    if(stateType == 'foreignState'){
      formData.append('selectState', $('#selectState').val());
      formData.append('selectDistrict', null);
    }
    else if(stateType == 'sriLanka'){
      formData.append('selectState', null);
      formData.append('selectDistrict', $('#selectDistrict').val());
    }

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/information/update/get-cities') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        console.log('success');
        if(data['status'] == 'error'){
          SwalNotificationErrorDanger.fire({title: 'Error!',text: $.each(data['errors'], function(key, value){value})});
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#city').find('option').remove().end().append('<option selected disabled>Select your city</option>')
          // APPEND CITY LIST
          if(data['city_list']){
            $.each(data['city_list'], function(key,value){
              $('#city').append($('<option>', { value: value.id,text : value.name}));
            })
          }
        }
      },
      error: function(err){
        console.log('error');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /ONCHANGE State GET Cities

  // ONCHANGE Current State GET Current Cities
  onChangeCurrentState = (currentStateType) => {
    //FORM PAYLOAD
    var formData = new FormData();
    // ADD DATA
    formData.append('currentStateType', currentStateType);
    if(currentStateType == 'foreignState'){
      formData.append('selectCurrentState', $('#selectCurrentState').val());
      formData.append('selectCurrentDistrict',null);
    }
    else if(currentStateType == 'sriLanka'){
      formData.append('selectCurrentState', null);
      formData.append('selectCurrentDistrict', $('#selectCurrentDistrict').val());
    }

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/information/update/get-cities') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        console.log('success');
        if(data['status'] == 'error'){
          SwalNotificationErrorDanger.fire({title: 'Error!', text: $.each(data['errors'], function(key, value){value})});
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#currentCity').find('option').remove().end().append('<option selected disabled>Select your city</option>')
          // APPEND CITY LIST
          if(data['city_list']){
            $.each(data['city_list'], function(key,value){
              $('#currentCity').append($('<option>', {value: value.id,text: value.name}));
            })
          }
        }
      },
      error: function(err){
        console.log('error');
        SwalSystemErrorDanger.fire();
      }
    });
  } 
  // /ONCHANGE State GET Current Cities

  // UPDATE CONTACT DETAILS
  update_contact_details = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "Your Contact details will be updated!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if(result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form payload
        var formData = new FormData($('#formUpdateContactDetails')[0]);

        // Update contact details controller
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/student/information/update/contact-details') }}",
          type: 'post',
          data: formData,  
          processData: false,
          contentType: false,         
          beforeSend: function(){
            // Show loader
            $("#spinnerContactDetails").removeClass('d-none');
            $('#btnUpdateContactDetails').attr('disabled','disabled');
          },
          success: function(data) {
            console.log('Success in update contact details ajax.');
            $("#spinnerContactDetails").addClass('d-none');
            $('#btnUpdateContactDetails').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating contact details.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
                window.location.hash = '#'+key;
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit contact details.');
              SwalDoneSuccess.fire({
                title: 'Successfully Updated!',
                text: 'Your Contact details has been updated.',
              })
              $('#modal-contact-details').modal('hide')
              location.reload();
            }
            else if (data['error']){
              SwalSystemErrorDanger.fire({
                title: 'Update Failed!',
                text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
              })
            }
          },
          error: function(err){
            console.log('Error in update contact details ajax.');
            $("#spinnerContactDetails").addClass('d-none');
            $('#btnUpdateContactDetails').removeAttr('disabled', 'disabled');
            SwalErrorDanger.fire({
              title: 'Update Failed!',
              text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
            })
          }
        })
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Contact details has not been updated.',
        })
      }
    })
  }
  // /UPDATE CONTACT DETAILS

  // UPDATE PASSWORD
  update_password = () => {
    
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();
    $('#InputCurrentPasswordHelp').show();
    $('#InputNewPasswordHelp').show();
    $('#InputReNewPasswordHelp').show();


    // FORM PAYLOAD
    var formData = new FormData($("#changePassword")[0]);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('change.password') }}",
      type: 'post',
      data: formData,  
      processData: false,
      contentType: false,         
      beforeSend: function(){
        // Show loader
        $("#spinnerPassword").removeClass('d-none');
        $('#btnChangePassword').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinnerPassword").addClass('d-none');
        $('#btnChangePassword').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('.form-text').hide();
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>')
          });
        }else if (data['success']){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'Password Updated!',
            text: 'Please Login with New Password to Continue',
          }).then((result) => {
            if(result.isConfirmed) {
              event.preventDefault(); 
              document.getElementById('logout-form').submit();
            }
          });
          
        }else if (data['error']){
          SwalErrorDanger.fire({
            title: 'Pasword Update Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinnerPassword").addClass('d-none');
        $('#btnChangePassword').removeAttr('disabled');
        SwalErrorDanger.fire({
          title: 'Pasword Update Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPDATE PASSWORD

  // RESET FORM
  reset_form = () => {    
        $('.form-control').val('');     
  }
  // /RESET FORM

  $(function(){
    
  });
</script>
