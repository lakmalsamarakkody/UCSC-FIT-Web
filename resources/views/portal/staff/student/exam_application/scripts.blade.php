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
                
                var appliedExams = '';
                $.each(data['student_applied_exams'], function(key, value) {
                    appliedExams += '<tr>';
                    appliedExams += '<td>'+value.subject_id+'</td>';
                    appliedExams += '<td>'+value.subject_id+'</td>';
                    appliedExams += '<td>'+value.exam_type_id+'</td>';
                    appliedExams += '<td>'+value.requested_exam_id+'</td>';
                    appliedExams += '<td>'+value.exam_schedule_id+'</td>';
                    appliedExams += '<td>'+
                    '<div class="btn-group">'+
                    '<button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-'+value.id+'" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i></button>'+
                    '<button type="button" class="btn btn-outline-warning" id="btnDeclineAppliedExam-'+value.id+'" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Decline Exam"><i class="fas fa-times-circle"></i></button>'+
                    '</div>'+
                    '</td>'
                    appliedExams += '</tr>';
                });
                $('#tblExams').append(appliedExams);
                
                $('#btnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                $('#spinnerBtnViewModalAppliedExams-'+student_id).removeAttr('disabled', 'disabled');
                $('#modal-view-exam-application').modal('show');
            }
        });
    }
</script>