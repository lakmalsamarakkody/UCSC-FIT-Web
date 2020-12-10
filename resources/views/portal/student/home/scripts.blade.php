@section('script')
<script type="text/javascript">

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


  $(function(){
    
  });
</script>
@endsection