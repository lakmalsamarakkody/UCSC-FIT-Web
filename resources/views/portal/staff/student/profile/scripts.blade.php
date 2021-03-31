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
      event.preventDefault();
      // alert(result.value);
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('update.email.request') }}",
          type: 'post',
          data: { 'email': result.value, 'id': "{{ $student->id }}"},         
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
        }).then((result1) => {
          //alert(result.value)
          if (result1.isConfirmed) { 
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{ route('reactivate.student') }}",
              type: 'post',
              data: { 'message': result1.value, 'id': "{{ $student->id }}"},         
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
          }
          else{
            SwalNotificationWarningAutoClose.fire({
              title: "Cancelled!",
              text: "Account did not activate",
            })
          }

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
        }).then((result1) => {
          //alert(result.value)
          if (result1.isConfirmed) { 
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{ route('deactivate.student') }}",
              type: 'post',
              data: { 'message': result1.value, 'id': "{{ $student->id }}"},         
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
          }
          else{
            SwalNotificationWarningAutoClose.fire({
              title: "Cancelled!",
              text: "Account not deactivated",
            })
          }

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

  // MEDICAL MODAL LOAD
  view_medical = (medical_id) => {

    var formData = new FormData();
    formData.append('medical_id', medical_id);
    
    // Get Medical Details controller
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ route('profile.medical.details') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {$('#modalProfileMedical-'+medical_id).attr('disabled', 'disabled')},
      success: function(data) {
        console.log('Success in get medical details ajax.');
        if(data['status'] == 'success') {
          if(data['medical'] != null && data['exam'] != null) {
            var date = new Date(data['medical']['created_at']);
            $('#spanMedicalSubmittedOn').html(date.toLocaleDateString());
            $('#spanMedicalStatus').html(data['medical']['status']);
            $('#spanMedicalSubject').html('FIT ' + data['exam']['subject_code'] + ' - ' + data['exam']['subject_name']);
            $('#spanMedicalExamType').html(data['exam']['exam_type']);
            $('#spanMedicalExamHeldDate').html(data['exam']['held_date']);
            $('#spanMedicalReason').html(data['medical']['reason']);
            $('#imgMedical').attr('style', 'background: url(/storage/medicals/'+data['student']['id']+'/'+data['medical']['image']+')');
            $('#imgMedical').attr('onclick', 'window.open("/storage/medicals/'+data['student']['id']+'/'+data['medical']['image']+'")');

            $('#modalProfileMedical-'+medical_id).removeAttr('disabled', 'disabled');
            $('#modal-profile-medical').modal('show');
          }
        }
      },
      error: function(err) {
        console.log('Error in get medical details ajax.');
        $('#modalProfileMedical-'+medical_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /MEDICAL MODAL LOAD
</script>
@endsection