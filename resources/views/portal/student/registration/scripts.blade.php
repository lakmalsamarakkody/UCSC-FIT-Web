<script type="text/javascript">

  // BODY ONLOAD
  $(document).ready(function(){

    // onChangeCitizenship()
    // address_editable()
    // edit_designation()

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
              SwalDoneSuccess.fire({
                title: 'Saved!',
                text: 'Information has been saved.',
              })
              $('input').attr('disabled','disabled')
              $('select').attr('disabled','disabled')
              $('#divCollapsePlus1').addClass('d-none')
              $('#divCollapsePlus2').addClass('d-none')
              $('#accept').removeAttr('disabled','disabled')
              $('#declaration').collapse('show')
              $('#divSaveInformation').addClass('d-none')
              $('#divResetForm').addClass('d-none')
              $('#divEditInformation').removeClass('d-none')
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
  // /SEND EMAIL

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
          SwalNotificationErrorDanger.fire({
            title: 'Error!',
            text: $.each(data['errors'], function(key, value){value}),
          });
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#country').find('option').remove().end().append('<option selected disabled>Select your country</option>')
          // APPEND COUNTRY LIST
          if(data['country_list']){
            $.each(data['country_list'], function(key,value)
            {
              $('#country').append($('<option>', { 
                  value: value.id,
                  text : value.name
              }));
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

    if($('#citizenship').val() == 'Sri Lankan') {
      // set visible selects
      $('#divSelectDistrict').collapse('show');
      $('#divSelectState').collapse('hide');
      $('#divSelectCurrentDistrict').collapse('show');
      $('#divSelectCurrentState').collapse('hide');
    }
    else if($('#citizenship').val() == 'Foreign National') {
      $('#divSelectDistrict').collapse('hide')
      $('#divSelectState').collapse('show')
      $('#divSelectCurrentDistrict').collapse('hide')
      $('#divSelectCurrentState').collapse('show')
    }
    else {
      $('#divSelectDistrict').collapse('hide')
      $('#divSelectState').collapse('hide')
      $('#divSelectCurrentDistrict').collapse('hide')
      $('#divSelectCurrentState').collapse('hide')
    }
  }
  // /ONCHANGE Citizenship GET Countrylist

  // ONCHANGE Country GET District/States
  onChangeCountry = () => {
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
          SwalNotificationErrorDanger.fire({
            title: 'Error!',
            text: $.each(data['errors'], function(key, value){value}),
          });
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#selectState').find('option').remove().end().append('<option selected disabled>Select your state</option>')
          $('#selectDistrict').find('option').remove().end().append('<option selected disabled>Select your district</option>')
          // APPEND COUNTRY LIST
          if(data['state_type'] == 'districts'){
            $.each(data['state_list'], function(key,value)
            {
              $('#selectDistrict').append($('<option>', { 
                  value: value.id,
                  text : value.name
              }));
            })
          }
          else if(data['state_type'] == 'divisions'){
            $.each(data['state_list'], function(key,value)
            {
              $('#selectState').append($('<option>', { 
                  value: value.id,
                  text : value.name
              }));
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


  // INSERT CURRENT ADDRESS
  address_editable = () => {
    //console.log('hello');
    if(document.getElementById("current_address").checked == true) {
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
      document.getElementById('currentHouse').setAttribute("disabled","disabled");
      document.getElementById('currentAddressLine1').setAttribute("disabled","disabled");
      document.getElementById('currentAddressLine2').setAttribute("disabled","disabled");
      document.getElementById('currentAddressLine3').setAttribute("disabled","disabled");
      document.getElementById('currentAddressLine4').setAttribute("disabled","disabled");
      document.getElementById('currentCity').setAttribute("disabled","disabled");
      document.getElementById('currentCountry').setAttribute("disabled","disabled");
      document.getElementById('plusCurrentField').setAttribute("disabled","disabled");
      document.getElementById('selectCurrentDistrict').setAttribute("disabled","disabled");
      document.getElementById('selectCurrentState').setAttribute("disabled","disabled");
    }
  }
  // /INSERT CURRENT ADDRESS

  //EDIT DESIGNATION
  edit_designation = () => {
    if(document.getElementById("empYes").checked == true) {
      $('#designation').removeAttr('disabled');
    }
    else{
      document.getElementById('designation').setAttribute("disabled","disabled");
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

  // EDIT INFORAMTION
  edit_information = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: 'Are you sure?',
      text: 'You will be able to edit your information.',
      confirmButtonText: 'Yes, Edit!',
    })

    .then((result) => {
      if(result.isConfirmed) {
        $('input').removeAttr('disabled','disabled')
        $('select').removeAttr('disabled','disabled')
        $('#divCollapsePlus1').removeClass('d-none')
        $('#divCollapsePlus2').removeClass('d-none')
        edit_designation()
        address_editable()
        $('#email').attr('disabled','disabled')
        $('#declaration').collapse('hide')
        $('#accept').removeAttr('checked','checked')
        $('#divSaveInformation').removeClass('d-none')
        $('#divEditInformation').addClass('d-none')
        $('#divSubmitButton').collapse('hide')
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

  </script>