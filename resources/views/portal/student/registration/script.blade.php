<script>
onChangeCountry = () => {
    // FORM PAYLOAD
    var formData = new FormData();
    // ADD DATA
    formData.append('country', $('#country').val())

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('/portal/student/registration/getstates') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        console.log('success');
        if(data['status'] == 'error'){
          SwalNotificationErrorDanger.fire({title: 'Error!',text: $.each(data['errors'], function(key, value){value}),
          });
        }
        else if (data['status'] == 'success'){
          // CLEAR CURRENT LIST
          $('#selectState').find('option').remove().end().append('<option selected disabled>Select your state</option>')
          $('#selectDistrict').find('option').remove().end().append('<option selected disabled>Select your district</option>')
          $('#city').find('option').remove().end().append('<option selected disabled>Select your city</option>')
          // APPEND COUNTRY LIST
          if(data['state_type'] == 'districts'){
            $.each(data['state_list'], function(key,value){
              $('#selectDistrict').append($('<option>', { value: value.id,text : value.name}));
            })
          }
          else if(data['state_type'] == 'divisions'){
            $.each(data['state_list'], function(key,value){
              $('#selectState').append($('<option>', { value: value.id,text : value.name}));
            })
            $.each(data['city_list'], function(key,value){
              $('#city').append($('<option>', { value: value.id,text : value.name}));
            })
          }
        }
      },
      error: function(err){
        console.log('error');
        SwalSystemErrorDanger.fire();
      }
    });
  }
</script>