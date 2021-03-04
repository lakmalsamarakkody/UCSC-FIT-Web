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
                $('#spinnerBtnViewModalAppliedExams-'+student_id).removeClass('d-none');
            },
            success: function(data) {
                console.log('Success in get applicant exam details ajax');
                if(data['status'] == 'success'){
                    var date = new Date(data['submitted_date']['updated_at']);
                    $('#spanSubmittedOn').html(date.toLocaleDateString());
                    $('#spanStudentName').html(data['student']['initials'] + ' ' +data['student']['last_name']);
                    $('#spanRegNumber').html(data['student']['reg_no']);

                    //Create applied exam table
                    $('.trAppliedExams').remove();
                    var appliedExams = '';
                    $.each(data['student_applied_exams'], function(key, value) {
                        appliedExams += '<tr class="trAppliedExams">';
                        appliedExams += '<td>FIT '+ value.subject_code +'</td>';
                        appliedExams += '<td>'+value.subject_name +'</td>';
                        appliedExams += '<td>'+value.exam_type +'</td>';
                        appliedExams += '<td>'+value.requested_month +' ' + value.requested_year+'</td>';
                        appliedExams += '<td>'+value.schedule_date +'</td>';
                        appliedExams += '<td>'+value.start_time+ ' - ' + value.end_time +'</td>';
                        // if(value.requested_month == 'April') {
                        //     appliedExams += '<td>'+'2021-04-26'+'</td>';
                        // }
                        // else {
                        //     appliedExams += '<td>'+'2021-09-18'+'</td>';
                        // }
                        appliedExams += '<td>'+'10:00AM-12:00PM'+'</td>';
                        appliedExams += '<td>'+
                        '<div class="btn-group">'+
                        '<button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-'+value.id+'" onclick="invoke_modal_schedule_exam('+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i><span id="spinnerBtnScheduleAppliedExam-'+value.id+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                        '<button type="button" class="btn btn-outline-warning" id="btnDeclineAppliedExam-'+value.id+'" data-tooltip="tooltip" data-placement="bottom" title="Decline Exam"><i class="fas fa-times-circle"></i></button>'+
                        '</div>'+
                        '</td></tr>';
                    });
                    $('#tblExams').append(appliedExams);
                    $('#btnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnViewModalAppliedExams-'+student_id).addClass('d-none');
                    $('#modal-view-exam-application').modal('show');
                }
            },
            error: function(err) {
                console.log('Error in get applicant exam details ajax.');
                $('#btnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                $('#spinnerBtnViewModalAppliedExams-'+student_id).addClass('d-none');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /INVOKE APPLIED EXAMS MODAL

    // INVOKE SCHEDULE EXAMS MODAL
    invoke_modal_schedule_exam = (applied_exam_id) => {

        $('#divSearchSchedules').html('');
        $('.trSchedule').remove();
        // Form Payload
        var formData = new FormData();
        formData.append('applied_exam_id', applied_exam_id);

        // Get applied subject schedule details
        $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.schedules.details') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {$('#btnScheduleAppliedExam-'+applied_exam_id).attr('disabled', 'disabled');},
            success: function(data) {
                console.log('Success in get applied subject schedules details ajax.');
                if(data['status'] == 'success') {
                    $('#spanAppliedSubject').html('FIT ' + data['applied_exam']['subject_code'] + ' - ' + data['applied_exam']['subject_name']);
                    $('#spanAppliedExamType').html(data['applied_exam']['exam_type']);
                    $('#spanRequestedExam').html(data['applied_exam']['requested_month'] + ' ' + data['applied_exam']['requested_year']);
                    $('#divSearchSchedules').append('<div class="row">'+
                                                '<div class="form-group col-xl-6 col-12">'+
                                                    '<select name="searchExam" id="searchExam" class="form-control">'+
                                                    '<option value="" selected hidden>Select Exam</option>'+
                                                    '@foreach ($exams as $exam)'+
                                                        '<option value="{{$exam->id}}">{{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}} {{$exam->year}} </option>'+
                                                    '@endforeach'+
                                                    '</select>'+
                                                '</div>'+
                                                '<div class="form-group col-xl-6 col-12">'+
                                                    '<button type="button" class="btn btn-outline-primary form-control" onclick="search_schedules_by_exam('+$('#searchExam').val()+','+applied_exam_id+');" id="btnSearchByExam"><i class="fa fa-search"></i>Search<span id="spinnerBtnSearchByExam" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                                                '</div>'+
                                            '</div>');
                    //Create exams schedules table related with applied exam
                    var schedule = '';
                    $.each(data['schedules'], function(key, value) {
                        schedule += '<tr class="trSchedule">';
                        schedule += '<td>'+ value.subject_name+'</td>';
                        schedule += '<td>'+ value.date+'</td>';
                        schedule += '<td>'+value.start_time+'</td>';
                        schedule += '<td>'+value.end_time+'</td>';
                        schedule += '<td>'+
                        '<div class="btn-group">'+
                        '<button type="button" class="btn btn-outline-primary" id="btnSetExamSchedule-'+value.id+'" onclick="set_schedule('+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam">Schedule<span id="spinnerBtnSetExamSchedule-'+value.id+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                        '</div>'+
                        '</td></tr>';
                    });
                    $('#tblSchedulesForAppliedExam').append(schedule);
                    $('#btnScheduleAppliedExam-'+applied_exam_id).removeAttr('disabled', 'disabled');
                    $('#modal-schedule-applied-exam').modal('show');
                }
            },
            error: function(err) {
                console.log('Error in get applied subject schedules details ajax.');
                $('#btnScheduleAppliedExam-'+applied_exam_id).removeAttr('disabled', 'disabled');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /INVOKE SCHEDULE EXAMS MODAL

    // SERACH SCHEDULES BY EXAM
    search_schedules_by_exam = (exam_id, applied_exam_id) => {

        $('.trSchedule').remove();
        // Form Payload
        var formData = new FormData();
        formData.append('exam_id', exam_id);
        formData.append('applied_exam_id', applied_exam_id);

        // Get applied subject schedule details
        $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.schedules.search') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btnSearchByExam').attr('disabled', 'disabled');
                $('#spinnerBtnSearchByExam').removeClass('d-none');
                },
            success: function(data) {
                console.log('Success in search schedules by exam ajax.');
                if(data['status'] == 'success') {
                    console.log('Success in search schedules by exam.');
                    //Create exams schedules table related with applied exam
                    // var schedule = '';
                    // $.each(data['serched_schedules'], function(key, value) {
                    //     schedule += '<tr class="trSchedule">';
                    //     schedule += '<td>'+ value.subject_name+'</td>';
                    //     schedule += '<td>'+ value.date+'</td>';
                    //     schedule += '<td>'+value.start_time+'</td>';
                    //     schedule += '<td>'+value.end_time+'</td>';
                    //     schedule += '<td>'+
                    //     '<div class="btn-group">'+
                    //     '<button type="button" class="btn btn-outline-primary" id="btnSetExamSchedule-'+value.id+'" onclick="set_schedule('+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam">Schedule<span id="spinnerBtnSetExamSchedule-'+value.id+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                    //     '</div>'+
                    //     '</td></tr>';
                    // });
                    //$('#tblSchedulesForAppliedExam').append(schedule);
                    $('#btnSearchByExam').removeAttr('disabled', 'disabled');
                    $('#spinnerBtnSearchByExam').addClass('d-none');
                    // $('#modal-schedule-applied-exam').modal('show');
                }
            },
            error: function(err) {
                console.log('Error in search schedules by exam ajax.');
                $('#btnSearchByExam').removeAttr('disabled', 'disabled');
                $('#spinnerBtnSearchByExam').addClass('d-none');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // SERACH SCHEDULES BY EXAM
</script>