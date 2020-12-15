@section('script')
<script type="text/javascript">
  // SEND EMAIL
  send_email = () => {
    var email = $('#email').val();
        $('#email').removeClass('is-invalid');
        $('#erremail').html('');
        $('#erremail').hide();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/student/registration') }}",
      type: 'post',
      data: {
          'email':email
      },            
      beforeSend: function(){
        // Show loader
        $("#emailSpinner").removeClass('d-none');
        $('#submit').attr('disabled','disabled');
        // $("#submit").addClass('disabled');
      },
      success: function(data){
        $("#emailSpinner").addClass('d-none');
        // $("#submit").removeClass('disabled');
        $('#submit').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#erremail').show();
            $('#email').addClass('is-invalid');
            $('#erremail').append('<strong>'+value+'</strong>')
          });
        }else if (data['success']){
          $('#email').val('');
          SwalNotificationSuccess.fire({
            title: 'Registration Link Emailed!',
            text: 'Please Check your Email',
          })
        }
      },
      error: function(err){
        console.log('error');
      }
    });
  }
  // /SEND EMAIL
</script>
@endsection