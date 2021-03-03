<script type="text/javascript">

    // INVOKE APPLIED EXAMS MODAL
    view_modal_applied_exams = (student_id) => {
        // Payload
        var formData = new FormData();
        formData.append('student_id', student_id);

        // Get student applied exam details
        $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.details') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btnViewModalAppliedExams-'+student_id).attr('disabled', 'disabled');
                $('#spinnerBtnViewModalAppliedExams-'+student_id).attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log('Success in get applicant exam details ajax');
                if(data['status'] == 'success'){
                    var date = new Date(data['submitted_date']['updated_at']);
                    $('#spanSubmittedOn').html(date.toLocaleDateString());

                    //Create applied exam table
                    $('.trAppliedExams').remove();
                    var appliedExams = '';
                    $.each(data['student_applied_exams'], function(key, value) {
                        appliedExams += '<tr class="trAppliedExams">';
                        appliedExams += '<td>FIT '+ value.subject_code+'</td>';
                        appliedExams += '<td>'+value.subject_name+'</td>';
                        appliedExams += '<td>'+value.exam_type+'</td>';
                        appliedExams += '<td>'+value.requested_month +' ' + value.requested_year+'</td>';
                        appliedExams += '<td>'+value.schedule_date+'</td>';
                        appliedExams += '<td>'+value.start_time+ ' - ' + value.end_time +'</td>';
                        appliedExams += '<td>'+
                        '<div class="btn-group">'+
                        '<button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-'+value.id+'" onclick="invoke_modal_schedule_exam('+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i></button>'+
                        '<button type="button" class="btn btn-outline-warning" id="btnDeclineAppliedExam-'+value.id+'" data-tooltip="tooltip" data-placement="bottom" title="Decline Exam"><i class="fas fa-times-circle"></i></button>'+
                        '</div>'+
                        '</td></tr>';
                    });
                    $('#tblExams').append(appliedExams);
                    $('#btnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                    $('#modal-view-exam-application').modal('show');
                }
            },
            error: function(err) {
                console.log('Error in get applicant exam details ajax.');
                $('#btnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                $('#spinnerBtnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /INVOKE APPLIED EXAMS MODAL

    // INVOKE SCHEDULE EXAMS MODAL
    invoke_modal_schedule_exam = (applied_exam_id) => {
        // Form Payload
        var formData = new FormData();
        formData.append('applied_exam_id', applied_exam_id);

        // Get applied subject schedule details
        $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.schedule.details') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnScheduleAppliedExam-'+applied_exam_id).attr('disabled', 'disabled');},
            success: function(data) {
                console.log('Success in get applied subject schedule details ajax.');
                if(data['status'] == 'success') {
                    $('#spanSubject').html('FIT ' + data['applied_exam']['subject_code'] + ' - ' + data['applied_exam']['subject_name']);
                    $('#spanExamType').html(data['applied_exam']['exam_type']);
                    $('#spanRequestedExam').html(data['applied_exam']['requested_month'] + ' ' + data['applied_exam']['requested_year']);
                    //Create exams schedules table related with applied exam
                    $('.trSchedule').remove();
                    var schedule = '';
                    $.each(data['schedules'], function(key, value) {
                        schedule += '<tr class="trSchedule">';
                        schedule += '<td>'+ value.subject_name+'</td>';
                        schedule += '<td>'+ value.date+'</td>';
                        schedule += '<td>'+value.start_time+'</td>';
                        schedule += '<td>'+value.end_time+'</td>';
                        schedule += '<td>'+
                        '<div class="btn-group">'+
                        '<button type="button" class="btn btn-outline-primary" id="btnSetExamSchedule-'+value.id+'" onclick="set_schedule('+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam">Schedule</button>'+
                        '</div>'+
                        '</td></tr>';
                    });
                    $('#tblSchedulesForAppliedExam').append(schedule);
                    $('#btnScheduleAppliedExam-'+applied_exam_id).removeAttr('disabled', 'disabled');
                    $('#modal-schedule-applied-exam').modal('show');
                }
            },
            error: function(err) {
                console.log('Error in get applied subject schedule details ajax.');
                $('#btnScheduleAppliedExam-'+applied_exam_id).removeAttr('disabled', 'disabled');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /INVOKE SCHEDULE EXAMS MODAL
</script>