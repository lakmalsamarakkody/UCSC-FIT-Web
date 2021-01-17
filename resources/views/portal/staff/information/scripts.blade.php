<script type="text/javascript">
  // EMAIL
  reset_email = () => {
    SwalQuestionSuccess.fire({
      input: 'email',
      inputLabel: 'Enter New E-mail',
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
  function select_profile_pic (path) {
    
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
  // SELECT PROFILE PIC

  // /SELECT PROFILE PIC

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
