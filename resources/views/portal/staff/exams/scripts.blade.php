<script type="text/javascript">
// CREATE EXAM SCHEDULE
  // CREATE
  create_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam schedule will be create.",
      confirmButtonText: "Yes, Create!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Created!",
          text: "Exam schedule created.",
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam schedule has not been created.",
        })
      }
    })
  }
  // /CREATE

  // EDIT
  edit_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam schedule will be update.",
      confirmButtonText: "Yes, Update!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Updated!",
          text: "Exam schedule updated.",
        })
        $('#editSchedule').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam schedule has not been updated.",
        })
      }
    })
  }
  // /EDIT

  // DELETE(BEFORE RELEASE)
  delete_before_release = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Scheduled exam has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Scheduled exam has not been deleted.',
        })
      }
    })
  }
  // /DELETE(BEFORE RELEASE)

  // APPROVE SCHEDULE
  approve_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "You wont be able to revert this!",
      confirmButtonText: "Yes, Approve!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Approved!',
          text: 'Scheduled exam has been approved.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Scheduled exam has not been approved.',
        })
      }
    })
  }
  // /APPROVE SCHEDULE

  // REQUEST SCHEDULE APPROVAL
  request_schedule_approval = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "You wont be able to revert this!",
      confirmButtonText: "Yes, Send Request!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Approval requested!',
          text: 'Approval request has been sent to Coordinator.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Approval request has not been sent.',
        })
      }
    })
  }
  // /REQUEST SCHEDULE APPROVAL

  // RELEASE INDIVIDUAL EXAM SCHEDULE
  relase_individual_schedule = () => {
    SwalQuestionSuccessAutoClose.fire ({
      title: "Are you sure ?",
      text: "You wont be able to revert this!",
      confirmButtonText: "Yes, Release!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Released!',
          text: 'Exam schedule released.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam schedule has not been released.',
        })
      }
    })
  }
  // /RELEASE INDIVIDUAL EXAM SCHEDULE

  // RELEASE ALL SCHEDULES
  release_schedules = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "You wont be able to revert this!",
      confirmButtonText: "Yes, Release!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Released!',
          text: 'Exam schedule released.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam schedule has not been released.',
        })
      }
    })
  }
  // /RELEASE ALL SCHEDULES

// /CREATE EXAM SCHEDULE


// EXAM SCHEDULES

  // POSTPONE
  postpone_exam = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam will be postpone.",
      confirmButtonText: "Yes, Postpone!",
    })
    .then((result) => {
      if(result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Postponed!",
          text: "Exam postponed.",
        })
        $('#postponeExam').modal('hide')
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam has not been postponed.",
        })
      }
    })
  }
  // /POSTPONE

  // DELETE(AFTER RELEASED)
  delete_after_release = () => {
    SwalQuestionDanger.fire({
      title: "Are you sure ?",
      text: "You wont be able to revert this!",
      confirmButtonText: 'Yes, Send request!',
    })
    .then((result) => {
      if(result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Request Delete!',
          text: 'Delete request has been sent to Coordinator.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Delete request has not been sent.',
        })
      }
    })
  }

  // /DELETE(AFTER RELEASED)

// /EXAM SCHEDULES

// EXAM LIST

  //CREATE
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
          url: "{{ url('/portal/staff/exams/createExam') }}",
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

// / EXAM LIST

</script>