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
                text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
              })
            }
          },
          error: function(err){
            $('body').removeClass('freeze');
            Swal.hideLoading();
            SwalErrorDanger.fire({
              title: 'Update Failed!',
              text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
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

  // BLOCK STUDENT
  block_activities = () => {
    SwalQuestionSuccess.fire({
      title: "Are you sure ?",
      text: "Student's future activities will be blocked",
      confirmButtonText: "Yes, Block!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('block.student') }}",
          type: 'post',
          data: {'id': "{{ $student->id }}"},         
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
                title: "Blocked!",
                text: "Student Activities Blocked",
              }).then((result) => {
                if(result.isConfirmed) {
                  location.reload()
                }
              });
            }else if (data['error']){
              SwalSystemErrorDanger.fire({
                title: 'Update Failed!',
                text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
              })
            }
          },
          error: function(err){
            $('body').removeClass('freeze');
            Swal.hideLoading();
            SwalErrorDanger.fire({
              title: 'Update Failed!',
              text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
            })
          }
        });        
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Account did not blocked",
        })
      }
    })
  }
  // /BLOCK STUDENT

  // UNBLOCK STUDENT
  unblock_activities = () => {
    SwalQuestionSuccess.fire({
      title: "Are you sure ?",
      text: "Student's future activities will be unblocked",
      confirmButtonText: "Yes, Unblock!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('unblock.student') }}",
          type: 'post',
          data: {'id': "{{ $student->id }}"},         
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
                title: "Un-blocked!",
                text: "Student Activities Unblocked",
              }).then((result) => {
                if(result.isConfirmed) {
                  location.reload()
                }
              });
            }else if (data['error']){
              SwalSystemErrorDanger.fire({
                title: 'Update Failed!',
                text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
              })
            }
          },
          error: function(err){
            $('body').removeClass('freeze');
            Swal.hideLoading();
            SwalErrorDanger.fire({
              title: 'Update Failed!',
              text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
            })
          }
        });        
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Account did not un-blocked",
        })
      }
    })
  }
  // /UNBLOCK STUDENT

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
                    text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
                  })
                }
              },
              error: function(err){
                $('body').removeClass('freeze');
                Swal.hideLoading();
                SwalErrorDanger.fire({
                  title: 'Update Failed!',
                  text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
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
                    text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
                  })
                }
              },
              error: function(err){
                $('body').removeClass('freeze');
                Swal.hideLoading();
                SwalErrorDanger.fire({
                  title: 'Update Failed!',
                  text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
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
          console.log('Success in get medical details.');
          if(data['medical'] != null && data['exam'] != null) {
            var submittedDate = new Date(data['medical']['created_at']);
            var heldDate = new Date(data['exam']['held_date']);
            $('#spanMedicalSubmittedOn').html(submittedDate.toLocaleDateString());
            
            // Medical Status with badges
            if(data['medical']['status'] == 'Pending') {
              $('#spanMedicalStatus').html("<h5><span class='badge badge-warning'>"+data['medical']['status']+"</span></h5>");
            }
            else if(data['medical']['status'] == 'Approved') {
              $('#spanMedicalStatus').html("<h5><span class='badge badge-success'>"+data['medical']['status']+"</span></h5>");
            }
            else if(data['medical']['status'] == 'Declined') {
              $('#spanMedicalStatus').html("<h5><span class='badge badge-danger'>"+data['medical']['status']+"</span></h5>");
            }
            else {
              $('#spanMedicalStatus').html("<h5><span class='badge badge-secondary'>"+'Decline to Resubmit'+"</span></h5>");
            }
            
            $('#spanMedicalSubject').html('FIT ' + data['exam']['subject_code'] + ' - ' + data['exam']['subject_name']);
            $('#spanMedicalExamType').html(data['exam']['exam_type']);
            $('#spanMedicalExamHeldDate').html(heldDate.toLocaleDateString());
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