@section('script')
<script type="text/javascript">

  // USER ROLE
  makeEditableRole = () =>{
    if($('#trChnageUserRole').hasClass('d-none')){
      $('#trChnageUserRole').removeClass('d-none')
    }else{
      $('#trChnageUserRole').addClass('d-none')
    }
  }
  change_userRole = () => {
    event.preventDefault();
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, update user role!',
    })
    .then((result) => {
      if(result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('user.update.role') }}",
          type: 'post',
          data: {'id': "{{ $user->id }}", 'roleID': $('#changeUserRole').val() },         
          beforeSend: function(){
            $('#spinnerUpdateRole').removeClass('d-none');
          },
          success: function(data){
            if(data['status'] == "success"){
              $('#spinnerUpdateRole').addClass('d-none');
              SwalDoneSuccess.fire({
                title: 'User role Updated!',
                text: 'User role Updated successfully',
              }).then((result) => {
                if(result.isConfirmed) {
                  location.reload();
                }
              });
            }else{
              SwalSystemErrorDanger.fire().then((result) => { location.reload(); });
            }
          },
          error: function(){
            $('#spinnerUpdateRole').addClass('d-none');
            $('#trChnageUserRole').addClass('d-none')
            SwalSystemErrorDanger.fire()
          }
        })
      }else{
        $('#trChnageUserRole').addClass('d-none')
        SwalNotificationWarningAutoClose.fire({
          title: 'Aborted!',
          text: 'User role update process aborted.',
        })
      }
    });
  }

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
      event.preventDefault();
      // alert(result.value);
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('user.update.email.request') }}",
          type: 'post',
          data: { 'email': result.value, 'id': "{{ $user->id }}"},         
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

  // ACTIVATE ACC
  activate_acc = () => {
    SwalQuestionSuccess.fire({
      title: "Are you sure ?",
      text: "Account will be re-activated",
      confirmButtonText: "Yes, Activate!",
    })
    .then((result) => {
      if (result.isConfirmed) {

        SwalQuestionSuccess.fire({
          title: "Reason to Re-activate ?",
          input: 'textarea',
          inputLabel: 'Message',
          inputPlaceholder: 'Type your message here...',
          inputAttributes: {
            'aria-label': 'Type your message here'
          },
          inputValidator: (value) => {
            if (!value) {
              return 'You need to write something!'
            }
          },
          timer: false,
          showCancelButton: true,
          confirmButtonText: "Re-activate!",
        }).then((result) => {
          //alert(result.value)
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('reactivate.user') }}",
            type: 'post',
            data: { 'message': result.value, 'id': "{{ $user->id }}"},         
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
                  title: "Activated!",
                  text: "Account Activated",
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

        })
        
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Account did not activate",
        })
      }
    })
  }
  // /ACTIVATE ACC

  // DE-ACTIVATE ACC
  deactivate_acc = () => {
    SwalQuestionDanger.fire({
      title: "Are you sure ?",
      text: "Account will be deactivated",
      confirmButtonText: "Yes, Deactivate!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalQuestionDanger.fire({
          title: "Reason to Deativate ?",
          input: 'textarea',
          inputLabel: 'Message',
          inputPlaceholder: 'Type your message here...',
          inputAttributes: {
            'aria-label': 'Type your message here'
          },
          inputValidator: (value) => {
            if (!value) {
              return 'You need to write something!'
            }
          },
          timer: false,
          showCancelButton: true,
          confirmButtonText: "Deactivate!",
        }).then((result) => {
          //alert(result.value)
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('deactivate.user') }}",
            type: 'post',
            data: { 'message': result.value, 'id': "{{ $user->id }}"},         
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
                  title: "Deactivated!",
                  text: "Account dectivated",
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
  // /DE-ACTIVATE ACC

  $(function(){
    
  });
</script>
@endsection