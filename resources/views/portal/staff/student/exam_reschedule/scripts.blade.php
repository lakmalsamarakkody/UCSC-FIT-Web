<script type="text/javascript">


// INVOKE RESCHEDULE EXAM MODAL
// SCHEDULES TABLE
let schedulesForRescheduleExam = null;
    schedules_for_reschedule_exam = (exam_id) => {
        $('.tbl-schedules-for-reschedule-exam').DataTable().clear().destroy();
        schedulesForRescheduleExam = $('.tbl-schedules-for-reschedule-exam').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            order: [1, "asc"],
            ajax: {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                url: "{{ route('student.exams.reschedule.table') }}",
                type: 'post',
                data: function(d) {
                    d.exam = $('#searchByExam').val();
                    d.exam_id = exam_id;
                },
            },
            columns: [
                {
                    data: 'subject_name',
                    name: 'subject_name'
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
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function(data, type, row) {
                        return row['subject_name'] + ' (' + row['exam_type'] + ')';
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        var btnGroup = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-outline-primary" id="btnModalExamReschedule-'+data+'" onclick="reschedule_exam('+exam_id+','+data+');">Reschedule<span id="spinnerBtnModalExamReschedule-'+data+'" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>'+
                            '</div>';
                        return btnGroup;
                    }
                },
            ]
        });
    }
    search_schedules_by_exam = (applied_exam_id) => {
            schedulesForRescheduleExam.draw();
    }
    // SCHEDULES TABLE

    // EXAM DETAILS
    view_modal_reschedule_exam = (exam_id) => {
        $('#divRescheduleSearch').html('');

        // Form Payload
        let formData = new FormData();
        formData.append('exam_id', exam_id);

        // Get reschedule exam details
        $.ajax({
            headers: {'X-CSRF-TOKEN' : $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.exams.reschedule.details') }}",
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btnViewModalRescheduleExam-'+exam_id).attr('disabled', 'disabled');
                $('#spinnerBtnViewModalRescheduleExam-'+exam_id).removeClass('d-none');
            },
            success: function(data) {
                console.log('Success in get reschedule exam details ajax.');
                if(data['status'] == 'success') {
                    if(data['exam'] != null && data['student'] != null) {
                        $('#spaneStudentName').html(data['student']['initials']+ ' ' +data['student']['last_name']);
                        $('#spanStudentRegNo').html(data['student']['reg_no']);
                        $('#spanRescheduleSubject').html('FIT ' + data['exam']['subject_code'] + ' - ' + data['exam']['subject_name']);
                        $('#spanRescheduleExamType').html(data['exam']['exam_type']);
                        $('#spanEarlierExamRequested').html(data['exam']['requested_year'] + ' ' +data['exam']['requested_month']);
                        let date = new Date(data['exam']['medical_approved_date']);
                        $('#spanMedicalApprovedDate').html(date.toLocaleDateString());
                        $('#divRescheduleSearch').append('<div class="row">'+
                                                '<div class="form-group col-xl-6 col-12">'+
                                                    '<select name="searchByExam" id="searchByExam" class="form-control" onchange="search_schedules_by_exam('+exam_id+');">'+
                                                    '<option value="" selected>Please Select Exam</option>'+
                                                    '@foreach ($exams as $exam)'+
                                                        '<option value="{{$exam->id}}">{{$exam->year}} {{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}}</option>'+
                                                    '@endforeach'+
                                                    '</select>'+
                                                '</div>'+
                                            '</div>');

                        schedules_for_reschedule_exam(exam_id);
                        $('#btnViewModalRescheduleExam-'+exam_id).removeAttr('disabled', 'disabled');
                        $('#spinnerBtnViewModalRescheduleExam-'+exam_id).addClass('d-none');
                        $('#modal-view-reschedule-exam').modal('show');
                    }
                }
            },
            error: function(err) {
                console.log('Érror in get reschedule exam details ajax.');
                $('#btnViewModalRescheduleExam-'+exam_id).removeAttr('disabled', 'disabled');
                $('#spinnerBtnViewModalRescheduleExam-'+exam_id).addClass('d-none');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /EXAM DETAILS
    // /INVOKE RESCHEDULE EXAM MODAL

    // RESCHEDULE EXAM
    reschedule_exam = (exam_id, schedule_id) => {
        SwalQuestionSuccessAutoClose.fire({
            title: "Are you sure ?",
            text: "Exam will be rescheduled.",
            confirmButtonText: "Yes, Reschedule!",
        })
        .then((result) => {
            if (result.isConfirmed) {
                // Form payload
                var formData = new FormData();
                formData.append('exam_id', exam_id);
                formData.append('schedule_id', schedule_id);

                // Reschedule exam controller
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('student.exams.reschedule.exam') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#btnModalExamReschedule-'+schedule_id).attr('disabled', 'disabled');
                        $('#spinnerBtnModalExamReschedule-'+schedule_id).removeClass('d-none');
                    },
                    success: function(data){
                        console.log('Success in reschedule exam ajax.');
                        $('#btnModalExamReschedule-'+schedule_id).removeAttr('disabled', 'disabled');
                        $('#spinnerBtnModalExamReschedule-'+schedule_id).addClass('d-none');
                        if(data['status'] == 'success'){
                            console.log('Success in reschedule exam.');
                            SwalDoneSuccess.fire({
                                title: "Rescheduled!",
                                text: "Exam has been rescheduled.",
                            })
                            .then((result) => {
                                if(result.isConfirmed) {
                                    location.reload();
                                }
                            });                         
                        }
                        else if(data['status'] == 'error'){
                            SwalSystemErrorDanger.fire();
                        }
                    },
                    error: function(err){
                        console.log('Error in reschedule exam ajax.')
                        $('#btnModalExamReschedule-'+schedule_id).attr('disabled', 'disabled');
                        $('#spinnerBtnModalExamReschedule-'+schedule_id).addClass('d-none');
                        SwalSystemErrorDanger.fire();
                    }
                });
            }
            else{
                SwalNotificationWarningAutoClose.fire({
                    title: "Cancelled!",
                    text: "Exam has not been rescheduled.",
                })
            }
        });
    }
    // /RESCHEDULE EXAM
</script>