<script type="text/javascript">

// APPLY FOR EXAMS
apply_for_exams = (student_id) => {
    SwalQuestionSuccessAutoClose.fire({
        title: 'Are you sure?',
        text: 'Selected exams will be applied.',
        confirmButtonText: 'Yes, Apply!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            // Form payload
            const applyExamCheck = [];
            const applySubject = [];
            const applyExamType = [];
            const requestedExam = [];

            $('.apply-exam-check').each(function() {
                if($(this).is(":checked")) {
                    applyExamCheck.push($(this).val());
                }
            });

            $('.apply-subject').each(function() {
                applySubject.push($(this).val());
            });

            $('.apply-exam-type').each(function() {
                applyExamType.push($(this).val());
            });

            $('.requested-exam').each(function() {
                requestedExam.push($(this).val());
            });

            // Apply for exams controller
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
                url: "{{ route('student.exam.apply') }}",
                type: 'post',
                data: {
                    student_id: student_id,
                    applyExamCheck: applyExamCheck,
                    applySubject: applySubject,
                    applyExamType: applyExamType,
                    requestedExam: requestedExam
                },
                // processData: false,
                // contentType: false,
                beforeSend: function() {
                    $('#btnApplyForExams').attr('disabled', 'disabled');
                    $('#spinnerBtnApplyForExams').removeClass('d-none');
                },
                success: function(data) {
                    console.log('Success in apply for exams ajax.');
                    $('#btnApplyForExams').removeAttr('disabled', 'disabled');
                    $('#spinnerBtnApplyForExams').addClass('d-none');
                    if(data['status'] == 'success') {
                        console.log('Succee in apply for exam.');
                        SwalDoneSuccess.fire({
                            title: 'Success!',
                            text: 'Selected exams have been applied.',
                        })
                        .then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(err) {
                    console.log('Error in apply for exams ajax.');
                    $('#btnApplyForExams').removeAttr('disabled', 'disabled');
                    $('#spinnerBtnApplyForExams').addClass('d-none');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
        else{
            SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Selected exams have not been applied.',
            })
        }
    });
}
// /APPLY FOR EXAMS
</script>