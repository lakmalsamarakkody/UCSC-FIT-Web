@section('script')
<script type="text/javascript">
  // PASSWORD
  reset_password = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Password reset email will be sent to the student",
      confirmButtonText: "Yes, Send!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalNotificationSuccess.fire({
          title: "Sent!",
          text: "Password reset link sent",
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Password reset link not sent",
        })
      }
    })
  }
  // /PASSWORD

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
      if (result.isConfirmed) {
        SwalNotificationSuccess.fire({
          title: "Sent!",
          text: "Verification email sent",
        })
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

  // ACTIVATE ACC
  activate_acc = () => {
    SwalQuestionSuccess.fire({
      title: "Are you sure ?",
      text: "Account will be activated",
      confirmButtonText: "Yes, Activate!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalNotificationSuccess.fire({
          title: "Activated!",
          text: "Account Activated",
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Account not activated",
        })
      }
    })
  }
  // /ACTIVATE ACC

  // ACTIVATE ACC
  deactivate_acc = () => {
    SwalQuestionDanger.fire({
      title: "Are you sure ?",
      text: "Account will be deactivated",
      confirmButtonText: "Yes, Deactivate!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalNotificationSuccess.fire({
          title: "Deactivated!",
          text: "Account dectivated",
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Account not deactivated",
        })
      }
    })
  }
  // /ACTIVATE ACC

  $(function(){
    
  });
</script>
@endsection