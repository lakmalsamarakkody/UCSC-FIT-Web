@section('script')
<script type="text/javascript">
  // SEND EMAIL
  send_email = () => {
    var email = $('#email').val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/student/registration') }}",
      type: 'post',
      data: {
          'email':email
      },
      success: function(data){
        $.each(data['errors'], function(key, value){
          $('#erremail').show();
          $('#email').addClass('is-invalid');
          $('#erremail').html('');
          $('#erremail').append('<strong>'+value+'</strong>')
        });
      },
      error: function(err){
        console.log('error');
      }
    });
  }
  // /SEND EMAIL
</script>
@endsection