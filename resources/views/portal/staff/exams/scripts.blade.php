<script type="text/javascript">

// YAJRA TABLES
// Upcoming Exams(before release)
$(function(){
  var beforeReleaseTable = $('.schedules-before-release-yajradt').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ url('/portal/staff/exams/schedules/before/release') }}",
    },
    columns: [
      {
        data: 'exam',
        name: 'exam'
      },
      {
        data: 'subject_code',
        name: 'subject_code'
      },
      {
        data: 'subject_name',
        name: 'subject_name'
      },
      {
        data: 'exam_type',
        name: 'exam_type'
      },
      {
        data: 'date',
        name: 'date'
      },
      {
        data: 'start_time',
        name: 'start_time'
      },
      {
        data: 'end_time',
        name: 'end_time'
      },
    ],
    columnDefs: [
      {
        targets: 1,
        render: function(data, type, row) {
          return 'FIT ' + data;
        }
      },
    ]
  });
});
// /Upcoming Exams(before release)

// Upcoming Exams(after release)
$(function() {

  var afterReleaseTable = $('.schedules-after-release-yajradt').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ url('/portal/staff/exams/schedules/after/release') }}",
    },
    columns: [
      {
        data: 'exam',
        name: 'exam'
      },
      {
        data: 'subject_code',
        name: 'subject_code'
      },
      {
        data: 'subject_name',
        name: 'subject_name'
      },
      {
        data: 'exam_type',
        name: 'exam_type'
      },
      {
        data: 'date',
        name: 'date'
      },
      {
        data: 'start_time',
        name: 'start_time'
      },
      {
        data: 'end_time',
        name: 'end_time'
      },
    ],
    columnDefs: [
      {
        targets: 1,
        render: function(data, type, row) {
          return 'FIT ' + data;
        }
      }
    ]
  });
});
// /Upcoming Exams(after release)

// Held Exams
$(function() {
  var heldTable = $('.held-exam-schedules-yajradt').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ url('/portal/staff/exams/schedules/held') }}",
    },
    columns: [
      {
        data: 'exam',
        name: 'exam'
      },
      {
        data: 'subject_code',
        name: 'subject_code'
      },
      {
        data: 'subject_name',
        name: 'subject_name'
      },
      {
        data: 'exam_type',
        name: 'exam_type'
      },
      {
        data: 'date',
        name: 'date'
      },
      {
        data: 'start_time',
        name: 'start_time'
      },
      {
        data: 'end_time',
        name: 'end_time'
      },
    ],
    columnDefs: [
      {
        targets: 1,
        render : function(data, type, row) {
          return 'FIT '+data;
        }
      }
    ]
  });
});
// /Held Exams
// /YAJRA TABLES


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
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form payload
        var formData = new FormData($('#formCreateSchedule')[0]);

        //Create schedule controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/exams/schedule/create') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateSchedule').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in create schedule ajax.');
            $('#btnCreateSchedule').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validate schedule data.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Create exam schedule success.');
              SwalDoneSuccess.fire({
                title: "Created!",
                text: "Exam schedule created.",
              })
              location.reload();
            }
          },
          error: function(err){
            console.log('Errors in create exam schedule ajax.');
            $('#btnCreateSchedule').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
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
  // Fill edit modal with relevant data
  edit_schedule_modal_invoke = (schedule_id) => {
    // Form payload
    var formData = new FormData();
    formData.append('schedule_id', schedule_id);

    // Edit schedule get details controller
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/exams/schedule/edit/details') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditSchedule-'+schedule_id).attr('disabled', 'disabled');},
      success: function(data){
        console.log('Success in edit schedule get details ajax.');
        if(data['status'] == 'success'){
          $('#editScheduleId').val(data['schedule']['id']);
          $('#editScheduleExam').val(data['schedule']['exam_id']);
          $('#editScheduleSubject').val(data['schedule']['subject_id']);
          $('#editScheduleExamType').val(data['schedule']['exam_type_id']);
          $('#editScheduleExamDate').val(data['schedule']['date']);
          $('#editScheduleStartTime').val(data['schedule']['start_time']);
          $('#editScheduleEndTime').val(data['schedule']['end_time']);
          $('#modal-edit-schedule').modal('show');
          $('#btnEditSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
        }
      },
      error: function(err){
        console.log('Error in edit schedule get details ajax.');
        $('#btnEditSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill edit modal with relevant data

  edit_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam schedule will be update.",
      confirmButtonText: "Yes, Update!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        // Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        // Form payload
        var formData = new FormData($('#formEditSchedule')[0]);

        // Edit exam schedule controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/exams/schedule/edit') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditSchedule').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit exam schedule ajax.');
            $('#btnModalEditSchedule').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating edit schedule data.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit exam schedule.');
              SwalDoneSuccess.fire({
                title: "Updated!",
                text: "Exam schedule updated.",
              })
              $('#modal-edit-schedule').modal('hide');
              location.reload();
            }
          },
          error: function(err){
            console.log('Error in edit exam schedule ajax.')
            $('#btnModalEditSchedule').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
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
  delete_before_release = (schedule_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Form payload
        var formData = new FormData();
        formData.append('schedule_id', schedule_id);

        //Delete exam schedule controller
        $.ajax({
          headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/exams/schedule/delete') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteExamSchedule-'+schedule_id).attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in delete exam schedule ajax.');
            //Remove deleted table row
            $('#tbl-examSchedule-tr-'+schedule_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Scheduled exam has been deleted.',
            })
          },
          error: function(err){
            console.log('Error in delete exam schedule ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
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
</script>