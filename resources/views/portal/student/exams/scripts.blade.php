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
            var formData = new FormData();
            formData.append($('input[name="applyExam"]:checked)'.value())
            formData.append('student_id', student_id);

            // Apply for exams controller
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
                url: "{{ route('student.exam.apply') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#btnApplyForExams').attr('disabled', 'disabled');
                    $('#spinnerBtnApplyForExams').removeClass('d-none');
                    },
                success: function(data) {
                    console.log('Success in apply for exams ajax.');
                    $('#btnApplyForExams').removeAttr('disabled', 'disabled');
                    $('#spinnerBtnApplyForExams').addClass('d-none');
                }
            });
            SwalDoneSuccess.fire({
                title: 'Success!',
                text: 'Selected exams have been applied.',
            })
        }
        else{
            SwalNotificationWarningAutoClose.fire({
            title: 'Cancelled!',
            text: 'Selected exams have not been applied.',
            })
        }
    })
}
// /APPLY FOR EXAMS
</script>