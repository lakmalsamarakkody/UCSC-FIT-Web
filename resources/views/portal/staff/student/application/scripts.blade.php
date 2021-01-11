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
        $('#spanSubmittedOn').html(data['registration']['created_at']);
        $('#spanTitle').html(data['student']['title']);
        $('#spanFirstName').html(data['student']['first_name']);
        $('#spanMiddleNames').html(data['student']['middle_names']);
        $('#spanInitials').html(data['student']['initials']);
        $('#spanLastName').html(data['student']['last_name']);
        $('#spanFullName').html(data['student']['full_name']);
        //$('#').html(data['student']['']);
        $('#spanDOB').html(data['student']['dob']);
        $('#spanCitizenship').html(data['student']['citizenship']);
        //$('#').html(data['student']['']);
        $('#spanEducation').html(data['student']['education']);
        $('#spanHouseNo').html(data['student']['permanent_house']);
        $('#spanAddress1').html(data['student']['permanent_address_line1']);
        $('#spanAddress2').html(data['student']['permanent_address_line2']);
        $('#spanAddress3').html(data['student']['permanent_address_line3']);
        $('#spanAddress4').html(data['student']['permanent_address_line4']);
        //$('#').html(data['student']['']);
        //$('#').html(data['student']['']);
        //$('#').html(data['student']['']);
        $('#spanCurrentHouseNo').html(data['student']['current_house']);
        $('#spanCurrentAddress1').html(data['student']['current_address_line1']);
        $('#spanCurrentAddress2').html(data['student']['current_address_line2']);
        $('#spanCurrentAddress3').html(data['student']['current_address_line3']);
        $('#spanCurrentAddress4').html(data['student']['current_address_line4']);
        //$('#').html(data['student']['']);
        //$('#').html(data['student']['']);
        //$('#').html(data['student']['']);
        $('#spanTelephoneCode').html(data['student']['telephone_country_code']);
        $('#spanTelephone').html(data['student']['telephone']);
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