<script type="text/javascript">

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