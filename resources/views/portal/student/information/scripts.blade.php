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
        SwalNotificationSuccessAutoClose.fire({
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

  // UPDATE ACCOUNT
  update_account = () => {
    
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();
    $('#InputPasswordHelp').show();


    // FORM PAYLOAD
    var formData = new FormData($("#changePassword")[0]);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "",
      type: 'post',
      data: formData,  
      processData: false,
      contentType: false,         
      beforeSend: function(){
        // Show loader
        $("#spinner").removeClass('d-none');
        $('#submit').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinner").addClass('d-none');
        $('#submit').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#erremail').show();
            $('.form-text').hide();
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>')
          });
        }else if (data['success']){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'User Account Created!',
            text: 'Please Login to Continue',
          });
          window.location.replace("{{ route('login') }}");
        }else if (data['error']){
          SwalErrorDanger.fire({
            title: 'Email Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#emailSpinner").addClass('d-none');
        $('#submit').removeAttr('disabled');
        SwalErrorDanger.fire({
          title: 'Email Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPDATE ACCOUNT

  // RESET FORM
  reset_form = () => {    
        $('.form-control').val('');     
  }
  // /RESET FORM

  $(function(){
    
  });
</script>
