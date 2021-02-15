<script type="text/javascript">

  $(function(){

    // TABLES
    // Before Release table
    var beforeReleaseTable = $('.schedules-before-release-yajradt').DataTable({
      processing: true,
      serverSide: true,
      searching: false,
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
        {
          data: 'id',
          name: 'id',
          orderable: false,
          searchable: false
        },
      ],
      columnDefs: [
        {
          targets: 1,
          render: function(data, type, row) {
            return 'FIT ' + data;
          }
        },
        {
          targets: 7,
          render: function(data, type, row) {
            var btnGroup = '<div class="btn-group">';
            if( row['schedule_approval'] == null || row['schedule_approval'] == 'declined' ){
                @if(Auth::user()->hasPermission('staff-exam-schedule-approve-request-permission') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-info" data-tooltip="tooltip" data-placement="bottom" title="Request Approval" id="btnRequestApprovalSchedule-'+data+'" onclick="request_schedule_approval('+data+');"><i class="fas fa-file-export"></i></button>';
                @endif
            }
            else if( row['schedule_approval'] == 'requested' ){
                @if(Auth::user()->hasPermission('staff-exam-schedule-approve-permission') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Approve" id="btnApproveSchedule-'+data+'" onclick="approve_schedule('+data+');"><i class="fas fa-check-circle"></i></button>'
                + '<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Decline" id="btnDeclineSchedule-'+data+'" onclick="decline_schedule('+data+');"><i class="fas fa-times-circle"></i></button>';
                @endif

            }
            else if( row['schedule_approval'] == 'approved' ){
                @if(Auth::user()->hasPermission('staff-exam-schedule-release-permission') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-primary" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Release" id="btnReleaseSchedule-'+data+'" onclick="relase_individual_schedule('+data+');" ><i class="fas fa-share-square"></i></button>';
                @endif
            }
            btnGroup = btnGroup + '<button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Edit" id="btnEditSchedule-'+data+'" onclick="edit_schedule_modal_invoke('+data+');"><i class="fas fa-edit"></i></button>'+
            '<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" id="btnDeleteExamSchedule-'+data+'" onclick="delete_before_release('+data+');"><i class="fas fa-trash-alt"></i></button>'+
            '</div>';
            return btnGroup;
          }
        }
      ]
    });
    // /Before Release table

    // After Release table
    var afterReleaseTable = $('.schedules-after-release-yajradt').DataTable({
      processing: true,
      serverSide: true,
      searching: false,
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
        {
          data: 'id',
          name: 'id',
          orderable: false,
          searchable: false
        },
      ],
      columnDefs: [
        {
          targets: 1,
          render: function(data, type, row) {
            return 'FIT ' + data;
          }
        },
        {
          targets: 7,
          render: function(data, type, row) {
            var btnGroup = '<div class="btn-group">'+
            '<button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Postpone Exam" id="btnPostponeSchedule-'+data+'" onclick="postpone_exam_modal_invoke('+data+');"><i class="fas fa-calendar-plus"></i></button>'+
            '<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" id="btnDeleteAfterRelease-'+data+'" onclick="delete_after_release('+data+');"><i class="fas fa-trash-alt"></i></button>'+
            '</div>';
            return btnGroup;

          }
        }
      ]
    });
    // /After Release table
    // /TABLES

    // UPCOMING EXAMS(before release)
    // Create schedule
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
                beforeReleaseTable.draw();
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
    // /Create schedule

    // Edit(before release)
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
                beforeReleaseTable.draw();
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
    // /Edit(before release)

    // Delete(before release)
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
              beforeReleaseTable.draw();
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
    // /Delete(before release)

    // Request schedule approval
    request_schedule_approval = (schedule_id) => {
      SwalQuestionSuccessAutoClose.fire({
        title: "Are you sure ?",
        text: "You wont be able to revert this!",
        confirmButtonText: "Yes, Send Request!",
      })
      .then((result) => {
        if(result.isConfirmed){
          //Form payload
          var formData = new FormData();
          formData.append('schedule_id', schedule_id);

          // Request schedule approval controller
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/portal/staff/exams/schedule/request/approval') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnRequestApprovalSchedule-'+schedule_id).attr('disabled', 'disabled');},
            success: function(data) {
              console.log('Success in request schedule approval ajax.');
              $('#btnRequestApprovalSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              if(data['status'] == 'errors') {
                SwalNotificationWarningAutoClose.fire({
                  title: 'Error!',
                  text: 'The id of the schedule is not found.',
                })
              }
              else if(data['status'] == 'requested'){
                SwalNotificationWarningAutoClose.fire({
                  title: 'Declined!',
                  text: 'The schedule has been already requested for approval.',
                })
              }
              else if(data['status'] == 'success') {
                SwalDoneSuccess.fire({
                  title: 'Approval requested!',
                  text: 'Schedule approval request has been sent to Coordinator.',
                })
                beforeReleaseTable.draw();
              }
            },
            error: function(err){
              console.log('Error in request schedule approval ajax.');
              $('#btnRequestApprovalSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          });
        }
        else{
          SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Schedule approval request has not been sent.',
          })
        }
      })
    }
    // /Request schedule approval

    // Approve schedule
    approve_schedule = (schedule_id) => {
      SwalQuestionSuccessAutoClose.fire({
        title: "Are you sure ?",
        text: "You wont be able to revert this!",
        confirmButtonText: "Yes, Approve!",
      })
      .then((result) => {
        if(result.isConfirmed){
          //Form payload
          var formData = new FormData();
          formData.append('schedule_id', schedule_id);

          // Approve Schedule controller
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/portal/staff/exams/schedule/approve') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnApproveSchedule-'+schedule_id).attr('disabled', 'disabled');},
            success: function(data) {
              console.log('Success in approve schedule ajax.');
              $('#btnApproveSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              if(data['status'] == 'errors') {
                SwalNotificationWarningAutoClose.fire({
                  title: 'Error!',
                  text: 'The id of the schedule is not found.',
                })
              }
              else if(data['status'] == 'success') {
                SwalDoneSuccess.fire({
                  title: 'Approved!',
                  text: 'Scheduled exam has been approved.',
                })
                beforeReleaseTable.draw();
                afterReleaseTable.draw();
              }
            },
            error: function(err){
              console.log('Error in approve schedule ajax.');
              $('#btnApproveSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          });
        }
        else{
          SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Scheduled exam has not been approved.',
          })
        }
      })
    }
    // /Approve schedule

    // Decline schedule
    decline_schedule = (schedule_id) => {
      SwalQuestionDangerAutoClose.fire({
        title: "Are you sure ?",
        text: "You wont be able to revert this!",
        confirmButtonText: "Yes, Decline!",
      })
      .then((result) => {
        if(result.isConfirmed){
          //Form payload
          var formData = new FormData();
          formData.append('schedule_id', schedule_id);

          // Decline Schedule controller
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/portal/staff/exams/schedule/decline') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnDeclineSchedule-'+schedule_id).attr('disabled', 'disabled');},
            success: function(data) {
              console.log('Success in decline schedule ajax.');
              $('#btnDeclineSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              if(data['status'] == 'errors') {
                SwalNotificationWarningAutoClose.fire({
                  title: 'Error!',
                  text: 'The id of the schedule is not found.',
                })
              }
              else if(data['status'] == 'success') {
                SwalDoneSuccess.fire({
                  title: 'Declined!',
                  text: 'Scheduled exam has been Declined.',
                })
                beforeReleaseTable.draw();
                afterReleaseTable.draw();
              }
            },
            error: function(err){
              console.log('Error in Decline schedule ajax.');
              $('#btnDeclineSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          });
        }
        else{
          SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Scheduled exam has not been Declined.',
          })
        }
      })
    }
    // /Decline schedule
    // /UPCOMING EXAMS(before release)

    // RELEASE SCHEDULES
    // Release individual exam schedule
    relase_individual_schedule = (schedule_id) => {
      SwalQuestionSuccessAutoClose.fire ({
        title: "Are you sure ?",
        text: "You wont be able to revert this!",
        confirmButtonText: "Yes, Release!",
      })
      .then((result) => {
        if(result.isConfirmed){

          // Form payload
          var formData = new FormData();
          formData.append('schedule_id', schedule_id);

          // Release individual schedule controller
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/portal/staff/exams/schedule/release/individual') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnReleaseSchedule-'+schedule_id).attr('disabled', 'disabled');},
            success: function(data) {
              console.log('Success in release individual schedule ajax.');
              $('#btnReleaseSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              if(data['status'] == 'errors') {
                SwalNotificationWarningAutoClose.fire({
                  title: 'Error!',
                  text: 'The id of the schedule is not found.',
                })
              }
              else if(data['status'] == 'decline') {
                SwalNotificationWarningAutoClose.fire({
                  title: 'Decline!',
                  text: 'The schedule not yet approved by the Coordinator.',
                })
              }
              else if(data['status'] == 'success') {
                SwalDoneSuccess.fire({
                  title: 'Released!',
                  text: 'Exam schedule released.',
                })
                beforeReleaseTable.draw();
                afterReleaseTable.draw();
              }
            },
            error: function(err) {
              console.log('Error in release individule schedule ajax.');
              $('#btnReleaseSchedule-', schedule_id).removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          });
        }
        else{
          SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Exam schedule has not been released.',
          })
        }
      })
    }
    // /Release individual exam schedule

    // Release all schedules
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
    // /Release all schedules
    // /RELEASE SCHEDULES

    // UPCOMING EXAMS(after release)
    // Postpone(after release)
    postpone_exam = () => {
      SwalQuestionSuccessAutoClose.fire({
        title: "Are you sure ?",
        text: "Exam will be postpone.",
        confirmButtonText: "Yes, Postpone!",
      })
      .then((result) => {
        if(result.isConfirmed) {

          // Remove previous validation error messages
          $('.form-control').removeClass('is-invalid');
          $('.invalid-feedback').html('');
          $('.invalid-feedback').hide();
          // Form Payload
          var formData = new FormData($('#formPostponeSchedule')[0]);

          // Postpone exam controller
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('#meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/portal/staff/exams/schedule/postpone') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnModalPostponeExam').attr('disabeld', 'disables');},
            success: function(data){
              console.log('Success in postpone exam ajax.');
              $('#btnModalPostponeExam').removeAttr('disabled', 'disabled');
              if(data['errors']) {
                console.log('Errors in validating postpone data.');
                $.each(data['errors'], function(key, value){
                  $('#error-'+key).show();
                  $('#'+key).addClass('is-invalid');
                  $('#error-'+key).append('<strong>'+value+'</strong>');
                });
              }
              else if(data['status'] == 'success') {
                console.log('Success in postpone exam.');
                SwalDoneSuccess.fire({
                  title: "Postponed!",
                  text: "Exam postponed.",
                })
                $('#modal-postpone-schedule').modal('hide');
                afterReleaseTable.draw();
              }
            },
            error: function(err) {
              console.log('Error in postpone exam ajax.');
              $('#btnModalPostponeExam').removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          });
        }
        else {
          SwalNotificationWarningAutoClose.fire({
            title: "Cancelled!",
            text: "Exam has not been postponed.",
          })
        }
      })
    }
    // /Postpone(after release)

    // Delete(after release)
    delete_after_release = (schedule_id) => {
      SwalQuestionDanger.fire({
        title: "Are you sure ?",
        text: "You wont be able to revert this!",
        confirmButtonText: 'Yes, Delete!',
      })
      .then((result) => {
        if(result.isConfirmed) {
          // Form Payload
          var formData = new FormData();
          formData.append('schedule_id', schedule_id);

          // Delete schedule after release controller
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/portal/staff/exams/schedule/delete/after/release') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('btnDeleteAfterRelease-'+schedule_id).attr('disabled', 'disabled');},
            success: function(data) {
              console.log('Success in delete schedule after rlease ajax.');
              $('btnDeleteAfterRelease-'+schedule_id).removeAttr('disabled', 'disabled');
              if(data['status'] == 'success') {
                console.log('Success in delete schedule after release.');
                SwalDoneSuccess.fire({
                  title: 'Deleted!',
                  text: 'Exam schedule has been deleted.',
                })
                afterReleaseTable.draw();
              }
              else if(data['status'] == 'errors') {
                console.log('Validation errors in delete schedule.');
                SwalNotificationWarningAutoClose.fire({
                  title: 'Error!',
                  text: 'The id of the schedule not found.',
                })
              }
            },
            error: function(err) {
              console.log('Error in delete schedule after release ajax.');
              $('#btnDeleteAfterRelease-'+schedule_id).removeAttr('disabled', 'disabeld');
              SwalSystemErrorDanger.fire();
            }
          });
        }
        else{
          SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Exam schedule has not been deleted.',
          })
        }
      })
    }
    // Delete(after release)
    // /UPCOMING EXAMS(after release)
  });

  // HELD EXAMS
  $(function() {
    var heldTable = $('.held-exam-schedules-yajradt').DataTable({
      searching: false,
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ url('/portal/staff/exams/schedules/held') }}",
        data: function(d) {
          d.year = $('#searchExamYear').val();
          d.exam = $('#searchExam').val();
          d.date = $('#searchExamDate').val();
          d.subject = $('#searchSubject').val();
          d.type = $('#searchExamType').val();
        }
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

    searchHeldExams = () => {
      heldTable.draw();
    }
  });
  // /HELD EXAMS

  // FILL EDIT MODAL WITH RELEVANT DATA
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
  // /FILL EDIT MODAL WITH RELEVANT DATA

  // FILL POSTPONE MODAL WITH RELEVANT DATA
  postpone_exam_modal_invoke = (schedule_id) => {
    // Form payload
    var formData = new FormData();
    formData.append('schedule_id',  schedule_id);

    // Postpone exam get details controller
    $.ajax({
      headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/exams/schedule/postpone/details') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType:  false,
      beforeSend: function() {$('#btnPostponeSchedule-'+schedule_id).attr('disabled', 'disabled');},
      success: function(data) {
        console.log('Success in postpone schedule get details ajax.');
        if(data['status'] == 'success') {
          $('#modal-postpone-schedule-title').html(data['subject']);
          $('#postponeExamId').val(data['schedule']['id']);
          $('#postponeExamDate').val(data['schedule']['date']);
          $('#postponeExamStartTime').val(data['schedule']['start_time']);
          $('#postponeExamEndTime').val(data['schedule']['end_time']);
          $('#modal-postpone-schedule').modal('show');
          $('#btnPostponeSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
        }
      },
      error: function(err) {
        console.log('Error in postpone schedule get details ajax.');
        $('#btnPostponeSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // FILL POSTPONE MODAL WITH RELEVANT DATA
</script>
