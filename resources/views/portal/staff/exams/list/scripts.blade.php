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
              }).then((result1) => {
                      reload();
                    })
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

  // DELETE
  onclick_delete_exam = (exam_id) => {
      SwalQuestionDanger.fire({
        title: "Are you sure?",
        text: "You wont be able to revert this!",
        confirmButtonText: 'Yes, delete it!',
      })
      .then((result) => {
          if(result.isConfirmed) {
            //Payload
            var formData = new FormData();
            formData.append('exam_id',exam_id);

            //Delete exam controller
            $.ajax({
                headears: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('/portal/staff/exams/list/delete') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){$('#btnDeleteExam-'+exam_id).attr('disabled', 'disabled');},
                success: function(data){
                    console.log('Success in delete exam ajax');
                    //Remove delete data included row
                    $('#tbl-exam-tr-'+exam_id).remove();
                    SwalDoneSuccess.fire({
                        title: 'Deleted!',
                        text: 'Exam has been deleted.',
                    }).then((result1) => {
                      reload();
                    })
                },
                error: function(err){
                    console.log('Error in delete exam ajax.');
                    SwalSystemErrorDanger.fire();
                }
            });
          }
          else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Exam has not been deleted.',
                })
            }
      })
  }
  // /DELETE

    $(function () {
      
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('results.exam.list') }}",
                data : function (d) {
                    d.year = $('#year').val();
                    d.month = $('#month').val();
                }
            },
            columns: [
                {
                    data: 'year', 
                    name: 'year'
                },
                {
                    data: 'month', 
                    name: 'month'
                },
                {
                    data: 'id', 
                    name: 'id', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: 2,
                    render: function ( data, type, row ) {
                        var buttons = '@if(Auth::user()->hasPermission("staff-exam-examList-viewResults"))<button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="View Results"><i class="fas fa-eye"></i></button>@endif'+
                                      '@if(Auth::user()->hasPermission("staff-exam-examList-delete"))<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete Exam" id="btnDeleteExam-'+data+'" onclick="onclick_delete_exam('+data+');"><i class="fas fa-trash-alt"></i></button>@endif'
                        
                        return buttons;
                    }

                }
            ]   
        });


        
        reload = () => {
            table.draw();

        }
    

  });
</script>