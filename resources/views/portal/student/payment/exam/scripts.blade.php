@section('script')
<script type="text/javascript">
  // SAVE PAYMENT
  save_payment = () => {

    
    // FORM PAYLOAD
    var formData = new FormData($("#examPaymentForm")[0]);
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('payment.exam.save') }}",
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
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'Payment Submitted to review!',
            text: 'You\'ll be notified once reviewed',
          }).then((result) => {
            if(result.isConfirmed) {
              location.reload()
            }
          });
        }else if (data['error']){
          SwalSystemErrorDanger.fire({
            title: 'PaymentFailed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#spinner").addClass('d-none');
        $('#btnSavePayment').removeAttr('disabled');
        SwalSystemErrorDanger.fire({
          title: 'PaymentFailed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /SAVE PAYMENT
</script>
@endsection