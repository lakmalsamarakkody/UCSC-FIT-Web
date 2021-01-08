<script type="text/javascript">
  // CREATE
  onclick_create_exam = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam will be create.",
      confirmButtonText: "Yes, Create!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form payload
        var formData = new FormData($('#formCreateExam')[0]);

        //Create exam
        $.ajax({
          headears: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/exams/list/create') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateExam').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in create exam ajax.');
            $('#btnCreateExam').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating exam data.');
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in create exam.');
              SwalDoneSuccess.fire({
                title: "Created!",
                text: "Exam created.",
              })
              location.reload();
              /*
              var newData = '<tr>';
              newData += '<td>'+data['exam']['year']+'</td>'+'<td>'+data['exam']['month']+'</td>'+'<td><div class="btn-group">'
                        +'<button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="View Results"><i class="fas fa-eye"></i></button>'
                        +'<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Delete Exam"><i class="fas fa-trash-alt"></i></button>'
                      +'</div></td></tr>';
              $('#tbodyExam').prepend(newData);
              $('#examYear').val('Default').attr('selected','selected');
              $('#examMonth').val('Default').attr('selected', 'selected'); */
            }
          },
          error: function(err){
            console.log('Error in create exam ajax.');
            $('#btnCreateExam').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam has not been created.",
        })
      }
    })
  }
  // /CREATE
</script>