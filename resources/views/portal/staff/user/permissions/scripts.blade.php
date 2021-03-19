<script type="text/javascript">
  $('#selectUserRole').change(function(){
    $('#formUserRole').submit();
  });

  permissionStatusChanger = (permissionID) =>{
    console.log(permissionID);
    console.log($('#inputCheck'+permissionID).prop('checked'));

    //FORMLOAD
    var formData = new FormData();
    formData.append('roleID', $('#selectUserRole').val());
    formData.append('permissionID', permissionID);
    if($('#inputCheck'+permissionID).prop('checked') == true){
      formData.append('permissionStatus', true);
    }else{
      formData.append('permissionStatus', false);
    }
    
    //AJAX
    $.ajax({
      headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('user.permission.change') }}",
      type: 'post',
      data:formData,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $('#inputCheck'+permissionID).attr('disabled','disabled');
      },
      success: function(data){
        $('#inputCheck'+permissionID).removeAttr('disabled','disabled');
      },
      error: function(err){
        $('#inputCheck'+permissionID).removeAttr('disabled','disabled');
        console.log('error in change permission status ajax');
        SwalSystemErrorDanger.fire();
      }
    });
  }
</script>