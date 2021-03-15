<script type="text/javascript">

    // INVOKE APPLIED EXAMS MODAL
    let appliedExamTable = null;
    applied_exam_table = (payment_id) => {
        appliedExamTable = $('.tbl-applied-exams').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                url: "{{ route('student.application.exams.details.table') }}",
                type: 'post',
                data: {'payment_id': payment_id},
            },
            columns: [
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
                    data: 'requested_exam',
                    name: 'requested_exam'
                },
                {
                    data: 'schedule_date',
                    name: 'schedule_date'
                },
                {
                    data: 'schedule_time',
                    name: 'schedule_time'
                },
                {
                    data: 'id',
                    name: 'id',
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function(data, type, row) {
                        return 'FIT ' + data;
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        if(data == null) {
                            return 'Not Scheduled'
                        }
                        else {
                            return data;
                        }
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        if(data == null) {
                            return 'Not Scheduled'
                        }
                        else {
                            return row['start_time'] + ' - ' + row['end_time'];
                        }
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        var btnGroup = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-'+data+'" onclick="invoke_modal_schedule_exam('+data+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i><span id="spinnerBtnScheduleAppliedExam-'+data+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                            '</div>';
                            return btnGroup;
                    }
                },

            ]
        });
    }

    view_modal_applied_exams = (payment_id) => {
        // Payload
        var formData = new FormData();
        formData.append('payment_id', payment_id);

        // Get student applied exam details
        $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.details') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btnViewModalAppliedExams-'+payment_id).attr('disabled', 'disabled');
                $('#spinnerBtnViewModalAppliedExams-'+payment_id).removeClass('d-none');
            },
            success: function(data) {
                console.log('Success in get applicant exam details ajax');
                if(data['status'] == 'success'){

                    // Details Tab
                    var date = new Date(data['submitted_date']['updated_at']);
                    $('#spanSubmittedOn').html(date.toLocaleDateString());
                    $('#spanStudentName').html(data['student']['initials'] + ' ' +data['student']['last_name']);
                    $('#spanRegNumber').html(data['student']['reg_no']);
                    applied_exam_table(payment_id);

                    // Payment Tab
                    if(data['payment'] != null) {
                        $('#paymentId').val(data['payment']['id']);
                        $('#spanPaymentDate').html(data['payment']['paid_date']);
                        $('#spanPaymentBank').html(data['payment']['bank']);
                        $('#spanPaymentBankBranch').html(data['payment']['bank_branch']);
                        $('#spanPaymentBankBranchCode').html(data['payment']['bank_branch_code']);
                        $('#spanPaymentAmount').html(data['payment']['amount']);
                        $('#imgExamPaymentBankSlip').attr('style', 'background: url(/storage/payments/exam/'+data['student']['id']+'/'+data['payment']['image']+')');
                        $('#imgExamPaymentBankSlip').attr('onclick', 'window.open("/storage/payments/exam/'+data['student']['id']+'/'+data['payment']['image']+'")');
                    }
                    
                    //Create applied exam table
                    // $('.trAppliedExams').remove();
                    // var appliedExams = '';
                    // $.each(data['student_applied_exams'], function(key, value) {
                    //     appliedExams += '<tr class="trAppliedExams">';
                    //     appliedExams += '<td>FIT '+ value.subject_code +'</td>';
                    //     appliedExams += '<td>'+value.subject_name +'</td>';
                    //     appliedExams += '<td>'+value.exam_type +'</td>';
                    //     appliedExams += '<td>'+value.requested_month +' ' + value.requested_year+'</td>';
                    //     if(value.schedule_date != null) {
                    //         appliedExams += '<td>'+value.schedule_date +'</td>';
                    //         appliedExams += '<td>'+value.start_time+ ' - ' + value.end_time +'</td>';
                    //     }
                    //     else {
                    //         appliedExams += '<td>Not Scheduled</td>';
                    //         appliedExams += '<td>Not Scheduled</td>';
                    //     }
                        
                    //     appliedExams += '<td>'+
                    //     '<div class="btn-group">'+
                    //     '<button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-'+value.id+'" onclick="invoke_modal_schedule_exam('+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i><span id="spinnerBtnScheduleAppliedExam-'+value.id+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                    //     '</div>'+
                    //     '</td></tr>';
                    // });
                    // $('#tblExams').append(appliedExams);
                    $('#btnViewModalAppliedExams-'+payment_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnViewModalAppliedExams-'+payment_id).addClass('d-none');
                    $('#modal-view-exam-application').modal('show');
                }
            },
            error: function(err) {
                console.log('Error in get applicant exam details ajax.');
                $('#btnViewModalAppliedExams-'+payment_id).removeAttr('disabled', 'disabled');
                $('#spinnerBtnViewModalAppliedExams-'+payment_id).addClass('d-none');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /INVOKE APPLIED EXAMS MODAL

    // APPROVE PAYMENT
    approve_exam_payment = () => {
        SwalQuestionWarningAutoClose.fire({
            title: "Are you sure?",
            text: "You wont be able to revert this!",
            confirmButtonText: 'Yes, Approve!',
        })
        .then((result) => {
            if(result.isConfirmed) {

            // Form Payload
            var formData = new FormData();
            formData.append('payment_id', $('#paymentId').val());

            // Approve exam payment controller
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('student.application.exams.payment.approve') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,           
                beforeSend: function(){
                    $("#spinnerBtnApproveExamPayment").removeClass('d-none');
                    $('#btnApproveExamPayment').attr('disabled','disabled');    
                },
                success: function(data){
                    console.log('Approve payment ajax success');
                    $("#spinnerBtnApproveExamPayment").addClass('d-none');
                    $('#btnApproveExamPayment').removeAttr('disabled');
                    if (data['status'] == 'success'){
                        SwalDoneSuccess.fire({
                            title: 'Approved!',
                            text: 'Payment approved successfully',
                        }).then((result) => {
                            if(result.isConfirmed) {
                                location.reload()
                            }
                        });
                    }
                    else {
                        SwalSystemErrorDanger.fire({
                            title: 'Payment Approve Process Failed!',
                        })
                    }
                },
                error: function(err) {
                    console.log('Approve exam payment ajax error');
                    $("#spinnerBtnApproveExamPayment").addClass('d-none');
                    $('#btnApproveExamPayment').removeAttr('disabled');
                    SwalSystemErrorDanger.fire({
                        title: 'Payment Approve Process Failed!',
                    })
                }
            });
            }
            else {
            SwalNotificationWarningAutoClose.fire({
                title: 'Aborted!',
                text: 'Payment approval process aborted.',
            })
            }
        })
    }
    // /APPROVE PAYMENT

    // DECLINE PAYMENT
    decline_exam_payment = () => {
        SwalQuestionDanger.fire({
            title: "Are you sure ?",
            text: "The exam payment will be declined",
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
                    if(result.isConfirmed) {
                        $.ajax({
                            headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ route('student.application.exams.payment.decline') }}",
                            type: 'post',
                            data: {'message': result.value, 'payment_id': $('#paymentId').val()},
                            beforeSend: function() {
                                $("#spinnerBtnDeclineExamPayment").removeClass('d-none');
                                $('#btnDeclineExamPayment').attr('disabled', 'disabled');
                                // $('body').addClass('freeze');
                                Swal.showLoading();
                            },
                            success: function(data) {
                                console.log('Success in decline exam payment ajax.');
                                $("#spinnerBtnDeclineExamPayment").addClass('d-none');
                                $('#btnDeclineExamPayment').removeAttr('disabled', 'disabled');
                                // $('body').removeClass('freeze');
                                Swal.hideLoading();
                                if(data['status'] == 'errors') {
                                    console.log('Errors in validating payment id.');
                                    SwalSystemErrorDanger.fire({
                                        title: 'Decline Failed!',
                                        text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                                    })
                                }
                                else if(data['status'] == 'success') {
                                    console.log('Success in decline exam payment.');
                                    SwalDoneSuccess.fire({
                                        title: 'Declined!',
                                        text: 'Exam payment has been Declined.',
                                    })
                                    // .then((result) => {
                                    //     if(result.isConfirmed) {
                                            
                                    //     }
                                    // });
                                }
                            },
                            error: function(err){
                                console.log('Error in decline exam payment ajax.');
                                $("#spinnerBtnDeclineExamPayment").addClass('d-none');
                                $('#btnDeclineExamPayment').removeAttr('disabled', 'disabled');
                                // $('body').removeClass('freeze');
                                SwalSystemErrorDanger.fire();
                            }
                        });
                    }
                    else {
                        SwalNotificationWarningAutoClose.fire({
                            title: 'Cancelled!',
                            text: 'Exam payment has not been Declined.',
                        })
                    }
                })
            }
            else {
                SwalNotificationWarningAutoClose.fire({
                    title: 'Cancelled!',
                    text: 'Exam payment has not been Declined.',
                })
            }
        })
    }
    // /DECLINE PAYMENT

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
                    $('#spanId').html(data['applied_exam']['id']);
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
                                                    '<button type="button" class="btn btn-outline-primary form-control" onclick="search_schedules_by_exam('+applied_exam_id+');" id="btnSearchByExam"><i class="fa fa-search"></i>Search<span id="spinnerBtnSearchByExam" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
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
                        '<button type="button" class="btn btn-outline-primary" id="btnModalSetExamSchedule-'+value.id+'" onclick="schedule_applied_exam('+applied_exam_id+','+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam">Schedule<span id="spinnerBtnModalSetExamSchedule-'+value.id+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
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
    search_schedules_by_exam = (applied_exam_id) => {

        $('.trSchedule').remove();
        // Form Payload
        var formData = new FormData();
        formData.append('exam_id', $('#searchExam').val());
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
                    var schedule = '';
                    $.each(data['searched_schedules'], function(key, value) {
                        schedule += '<tr class="trSchedule">';
                        schedule += '<td>'+ value.subject_name+'</td>';
                        schedule += '<td>'+ value.date+'</td>';
                        schedule += '<td>'+value.start_time+'</td>';
                        schedule += '<td>'+value.end_time+'</td>';
                        schedule += '<td>'+
                        '<div class="btn-group">'+
                        '<button type="button" class="btn btn-outline-primary" id="btnModalSetExamSchedule-'+value.id+'" onclick="schedule_applied_exam('+applied_exam_id+','+value.id+');" data-tooltip="tooltip"  data-placement="bottom" title="Schedule Exam">Schedule<span id="spinnerBtnModalSetExamSchedule-'+value.id+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                        '</div>'+
                        '</td></tr>';
                    });
                    $('#tblSchedulesForAppliedExam').append(schedule);
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

    // SCHEDULE APPLIED EXAM
    schedule_applied_exam = (applied_exam_id, schedule_id) => {
        SwalQuestionSuccessAutoClose.fire({
            title: "Are you sure ?",
            text: "Exam will be scheduled.",
            confirmButtonText: "Yes, Schedule!",
        })
        .then((result) => {
            if (result.isConfirmed) {
                // Form payload
                var formData = new FormData();
                formData.append('applied_exam_id', applied_exam_id);
                formData.append('schedule_id', schedule_id);

                // Edit exam schedule controller
                $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('student.application.exams.schedule.exam') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#btnModalSetExamSchedule-'+schedule_id).attr('disabled', 'disabled');
                    $('#spinnerBtnModalSetExamSchedule-'+schedule_id).removeClass('d-none');
                },
                success: function(data){
                    console.log('Success in schedule applied exam ajax.');
                    $('#btnModalSetExamSchedule-'+schedule_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnModalSetExamSchedule-'+schedule_id).addClass('d-none');
                    if(data['status'] == 'success'){
                        console.log('Success in schedule applied exam.');
                        SwalDoneSuccess.fire({
                            title: "Scheduled!",
                            text: "Exam has been scheduled.",
                        })
                        .then((result) => {
                            if(result.isConfirmed) {
                                appliedExamTable.draw();
                                $('#modal-schedule-applied-exam').modal('hide');
                            }
                        });                         
                    }
                    else if(data['status'] == 'error'){
                        SwalSystemErrorDanger.fire();
                    }
                },
                error: function(err){
                    console.log('Error in schedule applied exam ajax.')
                    $('#btnModalSetExamSchedule-'+schedule_id).attr('disabled', 'disabled');
                    $('#spinnerBtnModalSetExamSchedule-'+schedule_id).addClass('d-none');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
        else{
            SwalNotificationWarningAutoClose.fire({
                title: "Cancelled!",
                text: "Exam has not been scheduled.",
            })
        }
        });
    }
    // /SCHEDULE APPLIED EXAM

    // APPROVE SCHEDULES
    assign_scheduled_exams = () => {
        SwalQuestionSuccessAutoClose.fire({
            title: "Are you sure ?",
            text: "Schedules will be sent to the student!",
            confirmButtonText: "Yes, Approve!",
            })
            .then((result) => {
            if(result.isConfirmed){
                //Form Payload
                var formData = new FormData();
                formData.append('student_regno', $('#spanRegNumber').html());

                // Approve scheduled exams controller
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('student.application.exams.approve.schedules') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#btnAssignScheduledExams').attr('disabled', 'disabled');
                        $('#spinnerBtnAssignScheduledExams').removeClass('d-none');
                    },
                    success: function(data) {
                        console.log('Success in approve scheduled exams ajax.');
                        $('#btnAssignScheduledExams').removeAttr('disabled', 'disabled');
                        $('#spinnerBtnAssignScheduledExams').addClass('d-none');
                        if(data['status'] == 'success') {
                            console.log('Success in approve scheduled exams.');
                            SwalDoneSuccess.fire({
                                title: 'Released!',
                                text: 'Exam schedules have been sent to student.',
                            })
                            .then((result) => {
                                if(result.isConfirmed) {
                                    // $('#modal-view-exam-application').modal('hide');
                                    appliedExamTable.draw();
                                }
                            });
                        }
                        else if(data['status'] == 'error') {
                            console.log('Error in approve scheduled exams.');
                            SwalSystemErrorDanger.fire({
                                title: "Error",
                                text: data['msg'],
                            })
                        }
                    },
                    error: function(err) {
                        console.log('Errors in approve scheduled exams ajax.');
                        $('#btnAssignScheduledExams').removeAttr('disabled', 'disabled');
                        $('#spinnerBtnAssignScheduledExams').addClass('d-none');
                        SwalSystemErrorDanger.fire();
                    },
                });
            }
            else{
                SwalNotificationWarningAutoClose.fire({
                    title: 'Cancelled!',
                    text: 'Scheduled exams have not been approved.',
                })
            }
        })
    }
    // /APPROVE SCHEDULES
</script>