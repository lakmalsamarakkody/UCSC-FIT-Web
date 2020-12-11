<script type="text/javascript">


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

  // ACCEPT CONDITIONS
  accept_conditions = () => {
    if(document.getElementById("accept").checked == true) {
      $('#submitApplication').removeAttr('disabled');
    }
    else {
      document.getElementById('submitApplication').setAttribute("disabled","disabled");
    }
  }
  // /ACCEPT CONDITIONS

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

  // SAVE INFORMATION
  save_informatioin = () => {
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
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Information has not been saved.',
        })
      }
    })
  }
  // /SAVE INFORMATION

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

  // EDIT INFORAMTION
  edit_information = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: 'Are you sure?',
      text: 'You will be able to edit your information.',
      confirmButtonText: 'Yes, Edit!',
    })

    .then((result) => {
      if(result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Edit!',
          text: 'Form has been set to editable.',
        })
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

  </script>