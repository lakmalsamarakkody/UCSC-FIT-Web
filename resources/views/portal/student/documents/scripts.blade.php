@section('script')
<script type="text/javascript">

  // UPLOAD BIRTH CERTIFICATE
  upload_birth = () => {    
    // FORM PAYLOAD
    var formData = new FormData($("#birthCertificateForm")[0]);
    $('.birth').html('');
    $('.birth').hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('document.birth') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,           
      beforeSend: function(){
        // Show loader
        $("#spinnerBirth").removeClass('d-none');
        $('#btnSaveBirth').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinnerBirth").addClass('d-none');
        $('#btnSaveBirth').removeAttr('disabled');
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
            title: 'Birth Certificate Uploaded!',
            text: 'You\'ll be notified once reviewed',
          }).then((result) => {
            if(result.isConfirmed) {
              location.reload()
            }
          });
        }else if (data['error']){
          SwalSystemErrorDanger.fire({
            title: 'Upload Failed!',
          })
        }
      },
      error: function(err){
        $("#spinnerBirth").addClass('d-none');
        $('#btnSaveBirth').removeAttr('disabled');
        SwalSystemErrorDanger.fire({
          title: 'Upload Failed!',
        })
      }
    });
  }
  // /UPLOAD BIRTH CERTIFICATE

  // DELETE BIRTH CERTIFICATE
  delete_birth = () => {    

    SwalQuestionWarningAutoClose.fire({
      title: 'Are you sure?',
      text: 'You must upload your Birth Certificate once again if you delete.',
    }).then((result) => {
      if(result.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('document.birth.delete') }}",
          type: 'post',
          processData: false,
          contentType: false,           
          beforeSend: function(){
            // Show loader
            $("#spinnerDeleteBirth").removeClass('d-none');
            $('#btnDeleteBirth').attr('disabled','disabled');
          },
          success: function(data){
            $("#spinnerDeleteBirth").addClass('d-none');
            $('#btnDeleteBirth').removeAttr('disabled');
            if (data['status'] = 'success'){
              SwalDoneSuccess.fire({
                title: 'Birth Certificate Deleted!',
                text: 'Please upload corrected birth certificate again',
              }).then((result) => {
                if(result.isConfirmed) {
                  location.reload()
                }
              });
            }else{
              SwalSystemErrorDanger.fire({
                title: 'Delete Failed!',
              });
            }
          },
          error: function(err){
            $("#spinnerDeleteBirth").addClass('d-none');
            $('#btnDeleteBirth').removeAttr('disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Deletion Process Aborted!',
        });
      }
    });
  }
  // /DELETE BIRTH CERTIFICATE

  // UPLOAD IDENTITY
  upload_id = (document_type) => {    
    // FORM PAYLOAD
    var formData = new FormData($("#idDocumentForm")[0]);
    formData.append('document_type', document_type);
    $('.id-doc').html('');
    $('.id-doc').hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('document.id') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,           
      beforeSend: function(){
        // Show loader
        $("#spinnerId").removeClass('d-none');
        $('#btnSaveId').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinnerId").addClass('d-none');
        $('#btnSaveId').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>');
            window.location.hash = '#'+key;
          });
        }else if (data['status'] == 'success'){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'ID Uploaded!',
            text: 'You\'ll be notified once reviewed',
          }).then((result) => {
            if(result.isConfirmed) {
              location.reload()
            }
          });
        }else if (data['error']){
          SwalSystemErrorDanger.fire({
            title: 'Upload Failed!',
          })
        }
      },
      error: function(err){
        $("#spinnerId").addClass('d-none');
        $('#btnSaveId').removeAttr('disabled');
        SwalSystemErrorDanger.fire({
          title: 'Upload Failed!',
        })
      }
    });
  }
  // /UPLOAD IDENTITY

  // DELETE ID
  delete_ID = () => {    

    SwalQuestionWarningAutoClose.fire({
      title: 'Are you sure?',
      text: 'You must upload your ID Documents once again if you delete.',
    }).then((result) => {
      if(result.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('document.id.delete') }}",
          type: 'post',
          processData: false,
          contentType: false,           
          beforeSend: function(){
            // Show loader
            $("#spinnerDeleteID").removeClass('d-none');
            $('#btnDeleteID').attr('disabled','disabled');
          },
          success: function(data){
            $("#spinnerDeleteID").addClass('d-none');
            $('#btnDeleteID').removeAttr('disabled');
            if (data['status'] = 'success'){
              SwalDoneSuccess.fire({
                title: 'ID Deleted!',
                text: 'Please upload corrected ID again',
              }).then((result) => {
                if(result.isConfirmed) {
                  location.reload()
                }
              });
            }else{
              SwalSystemErrorDanger.fire({
                title: 'Delete Failed!',
              });
            }
          },
          error: function(err){
            $("#spinnerDeleteID").addClass('d-none');
            $('#btnDeleteID').removeAttr('disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Deletion Process Aborted!',
        });
      }
    });
  }
  // /DELETE ID

  //RESET FORM
  reset_form = (formName) => {
    console.log('reset form : '+formName);
    $(formName).trigger("reset");
    location.reload();
  }
  // /RESET FORM
</script>
@endsection