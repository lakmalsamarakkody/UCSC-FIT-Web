<script type="text/javascript">

  // BODY ONLOAD
  $(document).ready(function(){

    // CHECK COUNTRY AND SET STATE OR DISTRICT
    setViewDistrictState();
  });
  // /BODY ONLOAD

  // SAVE INFORMATION
  save_information = () => {

    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();

    // FORM PAYLOAD
    var formData = new FormData($("#registerForm")[0]);

    // ADD DATA
    //formData.append('user_role_name', $("#user_role_name").val())

    //validate information
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/registration/saveInfoValidator') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $('#btnSaveInformation').attr('disabled','disabled');
      },
      success: function(data){
        console.log('success');
        $('#btnSaveInformation').removeAttr('disabled','disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>')
          });
        }else if (data['success']){
          SwalQuestionSuccessAutoClose.fire({
            title: 'Are you sure?',
            text: 'Information you entered will be saved.',
            confirmButtonText: 'Yes, Save!',
          })
          .then((result) => {
            if(result.isConfirmed) {
              //Save Data to database
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('/portal/student/registration/saveInfo') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data){
                  SwalDoneSuccess.fire({
                    title: 'Saved!',
                    text: 'Information has been saved.',
                  });
                  $('input').attr('disabled','disabled')
                  $('select').attr('disabled','disabled')
                  $('#divCollapsePlus1').addClass('d-none')
                  $('#divCollapsePlus2').addClass('d-none')
                  $('#accept').removeAttr('disabled','disabled')
                  $('#declaration').collapse('show')
                  $('#divSaveInformation').addClass('d-none')
                  $('#divResetForm').addClass('d-none')
                  $('#divEditInformation').removeClass('d-none')
                },
                error: function(err){
                  console.log('error');
                  SwalSystemErrorDanger.fire()
                }
              });
            }
            else {
              SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Information has not been saved.',
              })
              $('#declaration').collapse('hide')
            }
          })
        }
      },
      error: function(err){
        $('#btnSaveInformation').removeAttr('disabled','disabled');
        console.log('error');
        SwalSystemErrorDanger.fire()
        
      }
    });
  }
  // /SAVE INFORMATION

  // EDIT INFORAMTION
  edit_information = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: 'Are you sure?',
      text: 'You will be able to edit your information.',
      confirmButtonText: 'Yes, Edit!',
    })

    .then((result) => {
      if(result.isConfirmed) {
        $('input').removeAttr('disabled','disabled');
        $('select').removeAttr('disabled','disabled');
        edit_designation();
        address_editable();
        $('#divCollapsePlus1').removeClass('d-none');
        $('#divCollapsePlus2').removeClass('d-none');
        $('#stu_email').attr('disabled','disabled');
        $('#declaration').collapse('hide');
        $('#accept').removeAttr('checked','checked');
        $('#divSaveInformation').removeClass('d-none');
        $('#divEditInformation').addClass('d-none');
        $('#divSubmitButton').collapse('hide');
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Form has not been set to editable.',
        })
      }
    })
  }
  // /EDIT INFORAMTION

  // ONCHANGE Citizenship GET Countrylist
  onChangeCitizenship = () => {
    // FORM PAYLOAD
    var formData = new FormData();
    // ADD DATA
    formData.append('citizenship', $('#citizenship').val())

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/registration/getcountries') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        console.log('success');
        if(data['status'] == 'error'){
          SwalNotificationErrorDanger.fire({title: 'Error!',text: $.each(data['errors'], function(key, value){value}),});
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#country').find('option').remove().end().append('<option selected disabled>Select your country</option>')
          $('#city').find('option').remove().end().append('<option selected disabled>Select your city</option>')
          // APPEND COUNTRY LIST
          if(data['country_list']){
            $.each(data['country_list'], function(key,value){
              $('#country').append($('<option>', { value: value.id,text : value.name}));
            })
            //$.each(data['country_list'], function(key,value){console.log( value.id + value.name)  });
          }
        }
      },
      error: function(err){
        console.log('error');
        SwalSystemErrorDanger.fire();
      }
    });

    setViewDistrictState();
  }
  // /ONCHANGE Citizenship GET Countrylist

  // ONCHANGE Country GET District/States
  onChangeCountry = () => {

    //SET DISTRICT OR STATE VIEW 
    if($('#country').val() == '67') {
      // set visible selects
      $('#divSelectDistrict').collapse('show');
      $('#divSelectState').collapse('hide');
      $('#citizenship').val('Sri Lankan');
    }
    else if($('#country').val() != '67') {
      $('#divSelectDistrict').collapse('hide')
      $('#divSelectState').collapse('show')
      $('#citizenship').val('Foreign National');
    }
    // FORM PAYLOAD
    var formData = new FormData();
    // ADD DATA
    formData.append('country', $('#country').val())

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/registration/getstates') }}",
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
      url: "{{ url('/portal/student/registration/getcities') }}",
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
       url: "{{ url('/portal/student/registration/getstates') }}",
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
            $('#divSelectCurrentState').collapse('hide');
            $('#divSelectCurrentDistrict').collapse('show');
            $.each(data['state_list'], function(key,value){
              $('#selectCurrentDistrict').append($('<option>',{value: value.id,text: value.name}));
            })
          }
          else if(data['state_type'] == 'divisions'){
            $('#divSelectCurrentDistrict').collapse('hide');
            $('#divSelectCurrentState').collapse('show');
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
      url: "{{ url('/portal/student/registration/getcities') }}",
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

  //VIEW DISTRICT OR STATE ACCORDING TO CITIZENSHIP
  setViewDistrictState = () => {
    if($('#citizenship').val() == 'Sri Lankan') {
      // set visible selects
      $('#divSelectDistrict').collapse('show');
      $('#divSelectState').collapse('hide');
    }
    else if($('#citizenship').val() == 'Foreign National') {
      $('#divSelectDistrict').collapse('hide');
      $('#divSelectState').collapse('show');
      //onChangeCitizenship();
    }
    else {
      $('#divSelectDistrict').collapse('hide');
      $('#divSelectState').collapse('hide');
    }
  }


  // INSERT CURRENT ADDRESS
  address_editable = () => {
    //console.log('hello');
    if($('#current_address').prop("checked")) {
      //console.log('disabled');
      $('#currentHouse').removeAttr('disabled');
      $('#currentAddressLine1').removeAttr('disabled');
      $('#currentAddressLine2').removeAttr('disabled');
      $('#currentAddressLine3').removeAttr('disabled');
      $('#currentAddressLine4').removeAttr('disabled');
      $('#currentCity').removeAttr('disabled');
      $('#currentCountry').removeAttr('disabled');
      $('#plusCurrentField').removeAttr('disabled');
      $('#selectCurrentDistrict').removeAttr('disabled');
      $('#selectCurrentState').removeAttr('disabled');
    }
    else{
      $('#currentHouse').attr('disabled','disabled');
      $('#currentAddressLine1').attr('disabled','disabled');
      $('#currentAddressLine2').attr('disabled','disabled');
      $('#currentAddressLine3').attr('disabled','disabled');
      $('#currentAddressLine4').attr('disabled','disabled');
      $('#currentCity').attr('disabled','disabled');
      $('#currentCountry').attr('disabled','disabled');
      $('#plusCurrentField').attr('disabled','disabled');
      $('#selectCurrentDistrict').attr('disabled','disabled');
      $('#selectCurrentState').attr('disabled','disabled');
    }
  }
  // /INSERT CURRENT ADDRESS

  //EDIT DESIGNATION
  edit_designation = () => {
    if($('#employement').prop("checked")) {
      $('#designation').removeAttr('disabled');
    }
    else{
      $('#designation').attr('disabled','disabled');
    }
  }
  // /EDIT DESIGNATION

  // RESET FORM
  reset_form = () => {
    SwalQuestionWarningAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Reset!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Reset!',
          text: 'Form has been reset.',
        })
        location.reload();
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Form has not been reset.',
        })
      }
    })
  }
  // /RESET FORM

  // ACCEPT CONDITIONS
  accept_conditions = () => {
    if(document.getElementById("accept").checked == true) {
      $('#divSubmitButton').collapse('show')
      $('#btnSubmitApplication').removeAttr('disabled')
    }
    else {
      $('#divSubmitButton').collapse('hide')
      $('#btnSubmitApplication').attr('disabled')
    }
  }
  // /ACCEPT CONDITIONS

  // SUBMIT APPLICATION
  submit_application = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: 'Are you sure?',
      text: 'You wont be able to revert this!',
      confirmButtonText: 'Yes, Submit!',
    })
    .then((result) => {
      if(result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Submitted!',
          text: 'Your information has been submitted for registration.',
        })
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Form has not been submitted.',
        })
      }
    })
  }
  // /SUBMIT APPLICATION

  </script>