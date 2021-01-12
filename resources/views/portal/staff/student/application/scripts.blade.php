<script type="text/javascript">

// INVOKE APPLICANT INFORMATION MODAL
view_modal_applicant = (student_id) => {
  // PAYLOAD
  var formData = new FormData();
  formData.append('student_id',student_id);

  // GET DETAILS
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "{{ route('student.application.applicantInfo') }}",
    type: 'post',
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function(){
      $('#btnViewModalApplicant-'+student_id).attr('disabled','disabled');
      $("#spinner").removeClass('d-none');
    },
    success: function(data){
      console.log('Success in invoke applicant modal get detials ajax.');
      if(data['status'] == 'success'){
        var date = new Date(data['registration']['created_at']);
        $('#spanSubmittedOn').html(date.toLocaleDateString());
        $('#spanTitle').html(data['student']['title']);
        $('#spanFirstName').html(data['student']['first_name']);
        $('#spanMiddleNames').html(data['student']['middle_names']);
        $('#spanInitials').html(data['student']['initials']);
        $('#spanLastName').html(data['student']['last_name']);
        $('#spanFullName').html(data['student']['full_name']);
        if(data['student']['gender'] == 'Male'){$('#iconGender').addClass('fa-male'); $('#spanGender').html('(Male)');}else{$('#iconGender').addClass('fa-female'); $('#spanGender').html('(Female)');};
        $('#spanDOB').html(new Date(data['student']['dob']).toLocaleDateString());
        $('#spanCitizenship').html(data['student']['citizenship']);
        //set IDs
        $('.trIDs').remove();
        if(data['student']['nic_old'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>NIC (old):</th><td>'+ data['student']['nic_old'] +'</td></tr>');}
        if(data['student']['nic_new'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>NIC (new):</th><td>'+ data['student']['nic_new'] +'</td></tr>');}
        if(data['student']['postal'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>Postal ID:</th><td>'+ data['student']['postal'] +'</td></tr>');}
        if(data['student']['passport'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>Passport ID:</th><td>'+ data['student']['passport'] +'</td></tr>');}
        
        $('#spanEducation').html(data['student']['education']);

        //permanent address
        $('#spanHouseNo').html(data['student']['permanent_house']);
        $('#spanAddress1').html(data['student']['permanent_address_line1']);
        $('#spanAddress2').html(data['student']['permanent_address_line2']);
        $('#spanAddress3').html(data['student']['permanent_address_line3']);
        $('#spanAddress4').html(data['student']['permanent_address_line4']);
        $('#spanCity').html(data['permanentAddressDetails']['permanentCity']);
        $('#spanState').html(data['permanentAddressDetails']['permanentState']);
        $('#spanCountry').html(data['permanentAddressDetails']['permanentCountry']);

        //current address
        $('#spanCurrentHouseNo').html(data['student']['current_house']);
        $('#spanCurrentAddress1').html(data['student']['current_address_line1']);
        $('#spanCurrentAddress2').html(data['student']['current_address_line2']);
        $('#spanCurrentAddress3').html(data['student']['current_address_line3']);
        $('#spanCurrentAddress4').html(data['student']['current_address_line4']);
        $('#spanCurrentCity').html(data['currentAddressDetails']['currentCity']);
        $('#spanCurrentState').html(data['currentAddressDetails']['currentState']);
        $('#spanCurrentCountry').html(data['currentAddressDetails']['currentCountry']);

        $('#spanTelephoneCode').html(data['student']['telephone_country_code']);
        $('#spanTelephone').html(data['student']['telephone']);
        $('#spanEmail').html(data['email']);
        $('#spanDesignation').html(data['student']['designation']);
        $("#spinner").addClass('d-none');
        $('#modal-view-applicant').modal('show');
        $('#btnViewModalApplicant-'+student_id).removeAttr('disabled','disabled');
      }
    },
    error: function(err){
      console.log('Error in invoke applicant modal get detials ajax.');
      $("#spinner").addClass('d-none');
      $('#btnViewModalApplicant-'+student_id).attr('disabled','disabled');
      SwalSystemErrorDanger.fire();
    }
  });
}
// /INVOKE APPLICANT INFORMATION MODAL

// DECLINE APPLICATION/PAYMENT
decline_application_payment = () => {
    SwalQuestionWarningAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Decline!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Declined!',
          text: 'Application/Payment declined. Message has been sent to the applicant.',
        })
        $('#modal-decline-message').modal('hide')
        $('#modal-view-applicant').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Application/Payment has not been declined.',
        })
      }
    })
  }
  // /DECLINE APPLICATION/PAYMENT

  // APPROVE APPLICATION
  approve_application = () => {
    SwalQuestionWarningAutoClose.fire({
        title: "Are you sure?",
        text: "You wont be able to revert this!",
        confirmButtonText: 'Yes, Approve!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            SwalDoneSuccess.fire({
                title: 'Approved!',
                text: 'The application has been approved.',
            })
            $('#modal-view-applicant').modal('hide')
        }
        else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Application has not been approved.',
            })
        }
    })
  }
  // /APPROVE APPLICATION

</script>