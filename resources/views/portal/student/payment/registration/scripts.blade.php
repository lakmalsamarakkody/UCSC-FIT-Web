@section('script')
<script type="text/javascript">
  // SEND EMAIL
  save_payment = () => {

    
    // FORM PAYLOAD
    var formData = new FormData($("#registerPaymentForm")[0]);
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/payment/registration') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,           
      beforeSend: function(){
        // Show loader
        $("#spinner").removeClass('d-none');
        $('#btnSavePayment').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinner").addClass('d-none');
        $('#btnSavePayment').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>');
            window.location.hash = '#'+key;
          });
        }else if (data['success']){
          $('#email').val('');
          SwalNotificationSuccessAutoClose.fire({
            title: 'Registration Link Emailed!',
            text: 'Please Check your Email',
          })
        }else if (data['error']){
          SwalNotificationWarning.fire({
            title: 'Email Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#emailSpinner").addClass('d-none');
        $('#submit').removeAttr('disabled');
        SwalNotificationWarning.fire({
          title: 'Email Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /SEND EMAIL
</script>
@endsection