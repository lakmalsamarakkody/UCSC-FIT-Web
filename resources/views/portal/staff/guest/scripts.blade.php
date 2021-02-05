<script type="text/javascript">

  // UPDATE ACCOUNT
  update_account = () => {
    
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();
    $('#InputPasswordHelp').show();


    // FORM PAYLOAD
    var formData = new FormData($("#updateAccount")[0]);

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('update.account.staff') }}",
      type: 'post',
      data: formData,  
      processData: false,
      contentType: false,         
      beforeSend: function(){
        // Show loader
        $("#spinner").removeClass('d-none');
        $('#submit').attr('disabled','disabled');
      },
      success: function(data){
        $("#spinner").addClass('d-none');
        $('#submit').removeAttr('disabled');
        if(data['errors']){
          $.each(data['errors'], function(key, value){
            $('#erremail').show();
            $('.form-text').hide();
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>')
          });
        }else if (data['success']){
          $('.form-control').val('');
          SwalDoneSuccess.fire({
            title: 'User Account Created!',
            text: 'Please Login to Continue',
          }).then((result) => {
            if(result.isConfirmed) {
              // event.preventDefault();
              $('#logout-form').submit();
            }
          });
        }else if (data['error']){
          SwalErrorDanger.fire({
            title: 'Account Creation Failed!',
            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err){
        $("#emailSpinner").addClass('d-none');
        $('#submit').removeAttr('disabled');
        SwalErrorDanger.fire({
          title: 'Account Creation Failed!',
          text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
        })
      }
    });
  }
  // /UPDATE ACCOUNT


  $(function(){
    
  });
</script>
