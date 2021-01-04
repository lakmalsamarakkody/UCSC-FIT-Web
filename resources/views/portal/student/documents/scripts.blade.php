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
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinnerBirth").addClass('d-none');
        $('#btnSaveBirth').removeAttr('disabled');
        SwalSystemErrorDanger.fire({
          title: 'Upload Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPLOAD BIRTH CERTIFICATE

    // UPLOAD BIRTH CERTIFICATE
  upload_id = () => {    
    // FORM PAYLOAD
    var formData = new FormData($("#idDocumentForm")[0]);
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
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinnerId").addClass('d-none');
        $('#btnSaveId').removeAttr('disabled');
        SwalSystemErrorDanger.fire({
          title: 'Upload Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPLOAD BIRTH CERTIFICATE
</script>
@endsection