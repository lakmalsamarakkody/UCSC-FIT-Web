<script type="text/javascript">

    // INVOKE RESCHEDULE EXAM MODAL
    view_modal_reschedule_exam = (exam_id) => {
        $('#divRescheduleSearchSchedules').html('');

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
                if(data['exam'] != null && data['student'] != null) {
                    $('#spaneStudentName').html(data['student']['initials']+ ' ' +data['student']['last_name']);
                    $('#spanStudentRegNo').html(data['student']['reg_no']);
                    $('#spanRescheduleSubject').html('FIT ' + data['exam']['subject_code'] + ' - ' + data['exam']['subject_name']);
                    $('#spanRescheduleExamType').html(data['exam']['exam_type']);
                    $('#spanEarlierExamRequested').html(data['exam']['requested_year'] + ' ' +data['exam']['requested_month']);
                    let date = new Date(data['exam']['medical_approved_date']);
                    $('#spanMedicalApprovedDate').html(date.toLocaleDateString());

                    $('#btnViewModalRescheduleExam-'+exam_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnViewModalRescheduleExam-'+exam_id).addClass('d-none');
                    $('#modal-view-reschedule-exam').modal('show');
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
    // /INVOKE RESCHEDULE EXAM MODAL
</script>