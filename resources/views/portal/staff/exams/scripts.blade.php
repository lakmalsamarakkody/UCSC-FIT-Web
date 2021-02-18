<script type="text/javascript">

let beforeReleaseTable = null;
let afterReleaseTable = null;
let heldExamTable = null;

  $(function(){
    // TABLES
    // Before Release table
    beforeReleaseTable = $('.schedules-before-release-yajradt').DataTable({
      processing: true,
      serverSide: true,
      searching: false,
      ajax: {
        url: "{{ url('/portal/staff/exams/schedules/before/release') }}",
      },
      columns: [
        {
          data: 'month',
          name: 'month',
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
          targets: 0,
          render: function(data, type, row) {
            var exam = row['month'] + " " + row['year'];
            return exam;
          }
        },
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
                if(row['schedule_approval'] == 'declined' && row['declined_message'] == null) {
                  @if(Auth::user()->hasPermission('staff-exam-schedule-decline-message'))
                  btnGroup = btnGroup + '<i data-tooltip="tooltip" data-placement="bottom" title="Approval Declined" class="fas fa-exclamation"></i>';
                  @endif
                }
                else if(row['schedule_approval'] == 'declined' && row['declined_message'] != null) {
                  @if(Auth::user()->hasPermission('staff-exam-schedule-decline-message'))
                  btnGroup = btnGroup + '<button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Approval Declined Message" id="btnViewDeclinedMessage-'+data+'" onclick="view_schedule_declined_message('+data+');"><i class="fas fa-envelope-open-text"></i></button>';
                  @endif
                }
                @if(Auth::user()->hasPermission('staff-exam-schedule-request') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-info" data-tooltip="tooltip" data-placement="bottom" title="Request Approval" id="btnRequestApprovalSchedule-'+data+'" onclick="request_schedule_approval('+data+');"><i class="fas fa-file-export"></i></button>';
                @endif
            }
            else if( row['schedule_approval'] == 'requested' ){
                @if(Auth::user()->hasPermission('staff-exam-schedule-approve') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-success" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Approve" id="btnApproveSchedule-'+data+'" onclick="approve_schedule('+data+');"><i class="fas fa-check-circle"></i></button>';
                @endif
                @if(Auth::user()->hasPermission('staff-exam-schedule-decline') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Decline" id="btnDeclineSchedule-'+data+'" onclick="decline_schedule('+data+');"><i class="fas fa-times-circle"></i></button>';
                @endif

            }
            else if( row['schedule_approval'] == 'approved' ){
                @if(Auth::user()->hasPermission('staff-exam-schedule-release') )
                btnGroup = btnGroup + '<button type="button" class="btn btn-outline-primary" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Release" id="btnReleaseSchedule-'+data+'" onclick="relase_individual_schedule('+data+');" ><i class="fas fa-share-square"></i></button>';
                @endif
            }
            @if(Auth::user()->hasPermission("staff-exam-schedule-edit"))
            btnGroup = btnGroup + '<button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Edit" id="btnEditSchedule-'+data+'" onclick="edit_schedule_modal_invoke('+data+');"><i class="fas fa-edit"></i></button>';
            @endif
            @if(Auth::user()->hasPermission("staff-exam-schedule-delete-beforeRelease"))
            btnGroup = btnGroup + '<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" id="btnDeleteExamSchedule-'+data+'" onclick="delete_before_release('+data+');"><i class="fas fa-trash-alt"></i></button>';
            @endif
            btnGroup = btnGroup + '</div>';
            return btnGroup;
          }
        }
      ]
    });
    // /Before Release table

    // After Release table
    afterReleaseTable = $('.schedules-after-release-yajradt').DataTable({
      processing: true,
      serverSide: true,
      searching: false,
      ajax: {
        url: "{{ url('/portal/staff/exams/schedules/after/release') }}",
      },
      columns: [
        {
          data: 'month',
          name: 'month'
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
          targets: 0,
          render: function(data, type, row) {
            var exam = row['month'] + " " + row['year'];
            return exam;
          }
        },
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
            '@if(Auth::user()->hasPermission("staff-exam-schedule-postpone"))<button type="button" class="btn btn-outline-warning" data-tooltip="tooltip" data-placement="bottom" title="Postpone Exam" id="btnPostponeSchedule-'+data+'" onclick="postpone_exam_modal_invoke('+data+');"><i class="fas fa-calendar-plus"></i></button>@endif'+
            '@if(Auth::user()->hasPermission("staff-exam-schedule-delete-afterRelease"))<button type="button" class="btn btn-outline-danger" data-tooltip="tooltip" data-placement="bottom" title="Delete" id="btnDeleteAfterRelease-'+data+'" onclick="delete_after_release('+data+');"><i class="fas fa-trash-alt"></i></button>@endif'+
            '</div>';
            return btnGroup;

          }
        }
      ]
    });
    // /After Release table

    // Held Exams table
    heldExamTable = $('.held-exam-schedules-yajradt').DataTable({
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
          data: 'month',
          name: 'month'
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
          targets: 0,
          render: function(data, type, row) {
            var exam = row['month'] + " " + row['year'];
            return exam;
          }
        },
        {
          targets: 1,
          render : function(data, type, row) {
            return 'FIT '+data;
          }
        }
      ]
    });

    searchHeldExams = () => {
      heldExamTable.draw();
    }
    // /Held exams table
    // /TABLES
  });

  // UPCOMING EXAMS(BEFORE RELEASE)
  // CREATE SCHEDULE
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
                $('.invalid-feedback').show();
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
              .then((result) => {
                if(result.isConfirmed) {beforeReleaseTable.draw();}
              });
            }
            else if(data['status'] == 'error'){
              SwalSystemErrorDanger.fire({
                title: "Error",
                text: data['msg'],
              })
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
  // /CREATE SCHEDULE

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

  // EDIT(BEFORE RELEASE)
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-schedule').modal('hide');
                  beforeReleaseTable.draw();
                }
              });
            }
            else if(data['status'] == 'error'){
              SwalSystemErrorDanger.fire({
                title: "Error",
                text: data['msg'],
              })
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
  // /EDIT(BEFORE RELEASE)

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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Scheduled exam has been deleted.',
            })
            .then((result) => {
                if(result.isConfirmed) {
                  beforeReleaseTable.draw();
                }
              });
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

  // REQUEST SCHEDULE APPROVAL
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
                title: 'Failed!',
                text: 'The id of the schedule is not found. Please Contact Administrator: admin@fit.bit.lk',
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
              .then((result) => {
                if(result.isConfirmed) {beforeReleaseTable.draw();}
              });
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
  // /REQUEST SCHEDULE APPROVAL

  // APPROVE SCHEDULE
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
                title: 'Failed!',
                text: 'The id of the schedule is not found. Please Contact Administrator: admin@fit.bit.lk',
              })
            }
            else if(data['status'] == 'success') {
              SwalDoneSuccess.fire({
                title: 'Approved!',
                text: 'Scheduled exam has been approved.',
              })
              .then((result) => {
                if(result.isConfirmed) {beforeReleaseTable.draw();}
              });
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
  // /APPROVE SCHEDULE

  // DECLINE SCHEDULE
  decline_schedule = (schedule_id) => {
    SwalQuestionDanger.fire({
      title: "Are you sure ?",
      text: "The schedule will be declined",
      confirmButtonText: "Yes, Decline!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalQuestionDanger.fire({
          title: "Reason to Decline ?",
          input: 'textarea',
          inputLabel: 'Message',
          inputPlaceholder: 'Type your message here...',
          inputAttributes: {'aria-label': 'Type your message here'},
          timer: false,
          showCancelButton: true,
          confirmButtonText: "Decline!",
        })
        .then((result) => {
          // Alert(result value)
          $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('schedule.decline') }}",
            type: 'post',
            data: {'message': result.value, 'schedule_id': schedule_id},
            beforeSend: function() {
              $('#btnDeclineSchedule-'+schedule_id).attr('disabled', 'disabled');
              $('body').addClass('freeze');
              Swal.showLoading();
            },
            success: function(data) {
              console.log('Success in decline schedule ajax.');
              $('#btnDeclineSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              $('body').removeClass('freeze');
              Swal.hideLoading();
              if(data['status'] == 'errors') {
                console.log('Errors in validating schedule id.');
                SwalNotificationWarningAutoClose.fire({
                title: 'Error!',
                text: 'The id of the schedule is not found.',
                })
              }
              else if(data['status'] == 'success') {
                console.log('Success in decline schedule.');
                SwalDoneSuccess.fire({
                  title: 'Declined!',
                  text: 'Scheduled exam has been Declined.',
                })
                .then((result) => {
                  if(result.isConfirmed) {
                    beforeReleaseTable.draw();
                  }
                });
              }
            },
            error: function(err){
              console.log('Error in Decline schedule ajax.');
              $('#btnDeclineSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          });
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Scheduled exam has not been Declined.',
        })
      }
    })
  }
  // /DECLINE SCHEDULE

  // FILL SCHEDULE DECLINED MESSAGE MODAL WITH RELEVANT DATA
  view_schedule_declined_message = (schedule_id) => {
    //Form payload
    var formData = new FormData();
    formData.append('schedule_id', schedule_id);

    //Get Schedule decline message controller
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ route('schedule.decline.message') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function() {$('#btnViewDeclinedMessage-'+schedule_id).attr('disabled', 'disabled');},
      success: function(data) {
        console.log('Success in get get schedule decline message ajax.');
        if(data['status'] == 'success') {
          console.log('Success in get schedule decline message.');
          $('#scheduleDeclineMessage').val(data['schedule']['declined_message']);
          $('#modal-schedule-declined-message').modal('show');
          $('#btnViewDeclinedMessage-'+schedule_id).removeAttr('disabled', 'disabled');
        }
        else if(data['status'] == 'errors') {
          console.log('Error in validate schedule id.');
          $('#btnViewDeclinedMessage-'+schedule_id).removeAttr('disabled', 'disabled');
          SwalNotificationWarningAutoClose.fire({
                title: 'Failed!',
                text: 'The id of the schedule is not found. Please Contact Administrator: admin@fit.bit.lk',
          })
        }
      },
      error: function(err) {
        console.log('Error in get schedule decline message ajax.');
        $('#btnViewDeclinedMessage-'+schedule_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      },
    });
  }
  // /FILL SCHEDULE DECLINE MESSAGE MODAL WITH RELEVANT DATA
  // /UPCOMING EXAMS(BEFORE RELEASE)

  // RELEASE SCHEDULES
  // RELEASE INDIVIDUAL EXAM SCHEDULE
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
                title: 'Failed!',
                text: 'The id of the schedule is not found. Please Contact Administrator: admin@fit.bit.lk',
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
              .then((result) => {
                if(result.isConfirmed) {
                  beforeReleaseTable.draw();
                  afterReleaseTable.draw();
                }
              });
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
  // /RELEASE INDIVIDUAL EXAM SCHEDULE

  // RELEASE ALL SCHEDULES
  release_schedules = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "All approved schedules will be released!",
      confirmButtonText: "Yes, Release!",
    })
    .then((result) => {
      if(result.isConfirmed){

        // Release all schedules controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('schedule.release.all') }}",
          type: 'post',
          processData: false,
          contentType: false,
          beforeSend: function() {
            $('#btnReleaseAllSchedules').attr('disabled', 'disabled');
            $('#spinnerBtnReleaseSchedules').removeClass('d-none');
            },
          success: function(data) {
            console.log('Success in release all schedules ajax.');
            $('#btnReleaseAllSchedules').removeAttr('disabled', 'disabled');
            $('#spinnerBtnReleaseSchedules').addClass('d-none');
            if(data['status'] == 'success') {
              SwalDoneSuccess.fire({
                title: 'Released!',
                text: 'Exam schedules have been released.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  beforeReleaseTable.draw();
                  afterReleaseTable.draw();
                }
              });
            }
          },
          error: function(err) {
            console.log('Error in release all schedules ajax.');
            $('#btnReleaseAllSchedules').removeAttr('disabled', 'disabled');
            $('#spinnerBtnReleaseSchedules').addClass('d-none');
            SwalSystemErrorDanger.fire();
          },
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam schedules have not been released.',
        })
      }
    })
  }
  // /RELEASE ALL SCHEDULES
  // /RELEASE SCHEDULES

  // UPCOMING EXAMS(AFTER RELEASE)
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
  // /FILL POSTPONE MODAL WITH RELEVANT DATA

  // POSTPONE(AFTER RELEASE)
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-postpone-schedule').modal('hide');
                  afterReleaseTable.draw();
                }
              });
            }
            else if(data['status'] == 'error'){
              SwalSystemErrorDanger.fire({
                title: "Error",
                text: data['msg'],
              })
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
  // /POSTPONE(AFTER RELEASE)

  // DELETE(AFTER RELEASE)
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
              .then((result) => {
                if(result.isConfirmed) {
                  afterReleaseTable.draw();
                }
              });
            }
            else if(data['status'] == 'errors') {
              console.log('Validation errors in delete schedule.');
              SwalNotificationWarningAutoClose.fire({
                title: 'Failed!',
                text: 'The id of the schedule is not found. Please Contact Administrator: admin@fit.bit.lk',
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
  // DELETE(AFTER RELEASE)
  // /UPCOMING EXAMS(AFTER RELEASE)

</script>
