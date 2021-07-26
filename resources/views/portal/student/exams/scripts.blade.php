<script type="text/javascript">

$(document).ready(function(){
    $('#selectAllSchedules').on('change', function () {
        $('.selected-schedules').not(this).prop('checked', this.checked);
    })
})

// APPLY FOR EXAMS
select_exams = () => {
    // Remove previous validation error messages
    // $('.form-control').removeClass('is-invalid');
    // $('.invalid-feedback').html('');
    // $('.invalid-feedback').hide();

    // Construct arrays of checked exams
    const applyExamCheck = [];
    // const applySubject = [];
    // const applyExamType = [];
    // const requestedExam = [];

    $('.apply-exam-check').each(function() {
        if($(this).is(":checked")) {
            applyExamCheck.push($(this).val());
        }
    });

    // $('.apply-subject').each(function() {
    //     applySubject.push($(this).val());
    // });

    // $('.apply-exam-type').each(function() {
    //     applyExamType.push($(this).val());
    // });

    // $('.requested-exam').each(function() {
    //     requestedExam.push($(this).val());
    // });
    // FORM PAYLOAD
    var formData = new FormData($("#formApplyExam")[0]);
    formData.append('applyExamCheck', applyExamCheck);
    // Apply for exams controller

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
        url: "{{ route('student.exam.select') }}",
        type: 'post',
        data: formData, 
        // {
            // student_id: student_id,
            // applyExamCheck: applyExamCheck,
            // applySubject: applySubject,
            // applyExamType: applyExamType,
            // requestedExam: requestedExam
        // },
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#btnApplyForExams').attr('disabled', 'disabled');
            $('#spinnerBtnApplyForExams').removeClass('d-none');
        },
        success: function(data) {
            console.log('Success in select exams ajax.');
            $('#btnApplyForExams').removeAttr('disabled', 'disabled');
            $('#spinnerBtnApplyForExams').addClass('d-none');
            // if(data['errors']) {
            //     console.log('Errors in validating data.');
            //     $.each(data['errors'], function(key, value) {
            //         $('#error-'+key).show();
            //         $('#'+key).addClass('is-invalid');
            //         $('#error-'+key).append('<strong>'+value+'</strong>');
            //     });
            // }
            if(data['status'] == 'nomonth') {
                console.log('Exams month have not been selected.');
                SwalNotificationWarningAutoClose.fire({
                    title: 'Select Exam Month!',
                    text: 'You did not select any exam month.',
                })
            }
            else if(data['status'] == 'unselected') {
                console.log('Exams have not been selected.');
                SwalNotificationWarningAutoClose.fire({
                    title: 'Unselected!',
                    text: 'You did not select any exam.',
                })
            }
            else if(data['status'] == 'exist') {
                console.log('Exam already selected.');
                SwalNotificationWarningAutoClose.fire({
                    title: 'Exam already Selected!',
                    text: 'Selected an existing exam',
                })
            }
            else if(data['status'] == 'hasonlymonth') {
                console.log('Exam not selected.');
                SwalNotificationWarningAutoClose.fire({
                    title: 'Exam not Selected!',
                    text: 'Select the exam and choose a month',
                })
            }
            else if(data['status'] == 'passed') {
                console.log('Exam Passed');
                SwalNotificationWarningAutoClose.fire({
                    title: 'Exam already passed!',
                    text: 'You have passed the exam already',
                })
            }
            else if(data['status'] == 'success') {
                console.log('Success in select exam.');
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
            console.log('Error in select exams ajax.');
            $('#btnApplyForExams').removeAttr('disabled', 'disabled');
            $('#spinnerBtnApplyForExams').addClass('d-none');
            SwalSystemErrorDanger.fire();
        }
    });

}
// /APPLY FOR EXAMS


// CANCEL SELECTION
cancel_selection = (id) => {

    SwalQuestionDangerAutoClose.fire({
        title: 'Are you sure?',
        text: 'Selected exams will be deleted.',
        confirmButtonText: 'Yes, Delete!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
                url: "{{ route('student.exam.delete') }}",
                type: 'post',
                data:  
                {
                    student_exam_id : id
                },
                beforeSend: function() {
                    $('.btn').attr('disabled', 'disabled');
                },
                success: function(data) {
                    console.log('Success in delete exams ajax.');
                    $('.btn').removeAttr('disabled', 'disabled');

                    if(data['status'] == 'success') {
                        console.log('Success in delete exam.');
                        SwalDoneSuccess.fire({
                            title: 'Success!',
                            text: 'Exam have been deleted.',
                        })
                        .then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        console.log('Error in delete exam.');
                        SwalSystemErrorDanger.fire();
                    }
                },
                error: function(err) {
                    console.log('Error in delete exams ajax.');
                    $('.btn').removeAttr('disabled', 'disabled');
                    SwalSystemErrorDanger.fire();
                }
            });



        }
        else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Selected exams have not been deleted.',
            })
        }
    });
}
// /CANCEL SELECTION


// CANCEL SELECTION
apply_for_exams = () => {

    SwalQuestionSuccessAutoClose.fire({
        title: 'Are you sure?',
        text: 'Selected exams will be applied.',
        confirmButtonText: 'Yes, Apply!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            $(location).attr('href', '{{ route('payment.exam') }}') 
        }
        else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Selected exams have not been applied.',
            })
        }
    });
}
// /CANCEL SELECTION

// EXAM DECLINED MESSAGE MODAL LOAD
view_exam_declined_message = (id) => {

    // Form payload
    var formData = new FormData();
    formData.append('id', id);

    // Get declined message controller
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('student.exam.declined.message') }}",
        type:'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {$('#btnViewDeclinedMessage-'+id).attr('disabled', 'disabled')},
        success: function(data) {
            console.log('Success in get Exam declined mesasge ajax.');
            if(data['status'] == 'success') {
                console.log('Success in get Exam declined mesasge.');
                $('#btnViewDeclinedMessage-'+id).removeAttr('disabled', 'disabled');
                if(data['declined_exam'] != null) {
                    $('#spanExamDeclinedMessage').html(data['declined_exam']['declined_message']);
                    $('#modal-exam-declined-message').modal('show');
                }
            }
            else if (data['status'] == 'error') {
                console.log('Error in get Exam declined mesasge.');
                $('#btnViewDeclinedMessage-'+id).removeAttr('disabled', 'disabled');
                SwalSystemErrorDanger.fire();
            }
        },
        error: function(err) {
            console.log('Error in get Exam declined mesasge ajax.');
            $('#btnViewDeclinedMessage-'+id).removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
        } 
    })
}
// /EXAM DECLINED MESSAGE MODAL LOAD

upload_medical = (id) => {
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();
    // FORM PAYLOAD
    var formData = new FormData($("#"+id+"-medicalUploadform")[0]);
    formData.append('id', id);


    SwalQuestionSuccessAutoClose.fire({
        title: 'Are you sure?',
        text: 'Medical will be uploaded',
        confirmButtonText: 'Yes, Upload!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
                url: "{{ route('student.exam.medical.upload') }}",
                type: 'post',
                data: formData, 
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.btn').attr('disabled', 'disabled');        
                    $("#"+id+"-spinnermedicalUpload").removeClass('d-none');
                },
                success: function(data) {

                    console.log('Success in upload medical ajax.');
                    $('.btn').removeAttr('disabled', 'disabled');
                    $("#"+id+"-spinnermedicalUpload").addClass('d-none');

                    if(data['errors']){
                        $.each(data['errors'], function(key, value){
                            $("#"+id+"-error-"+key).show();
                            $("#"+id+"-"+key).addClass('is-invalid');
                            $("#"+id+"-error-"+key).append('<strong>'+value+'</strong>')
                        });
                    }else if(data['status'] == 'success') {
                        console.log('Success in upload medical.');
                        SwalDoneSuccess.fire({
                            title: 'Success!',
                            text: 'Medical has been uploaded',
                        })
                        .then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        console.log('Error in upload medical.');
                        SwalSystemErrorDanger.fire();
                    }
                },
                error: function(err) {
                    console.log('Error in upload medical ajax.');
                    $('.btn').removeAttr('disabled', 'disabled');
                    $("#"+id+"-spinnermedicalUpload").addClass('d-none');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
        else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Medical has not been uploaded',
            })
        }
    });
}


// DELETE MEDICAL
delete_medical = (id) => {

    SwalQuestionDangerAutoClose.fire({
        title: 'Are you sure?',
        text: 'Uploaded Medical will be deleted.',
        confirmButtonText: 'Yes, Delete!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
                url: "{{ route('student.exam.medical.delete') }}",
                type: 'post',
                data:  
                {
                    'id' : id
                },
                beforeSend: function() {
                    $('.btn').attr('disabled', 'disabled');
                },
                success: function(data) {
                    console.log('Success in delete medical ajax.');
                    $('.btn').removeAttr('disabled', 'disabled');

                    if(data['status'] == 'success') {
                        console.log('Success in delete medical.');
                        SwalDoneSuccess.fire({
                            title: 'Success!',
                            text: 'Medical have been deleted.',
                        })
                        .then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        console.log('Error in delete medical.');
                        SwalSystemErrorDanger.fire();
                    }
                },
                error: function(err) {
                    console.log('Error in delete medical ajax.');
                    $('.btn').removeAttr('disabled', 'disabled');
                    SwalSystemErrorDanger.fire();
                }
            });



        }
        else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Selected exams have not been deleted.',
            })
        }
    });
}
// /DELETE MEDICAL


// REQUEST RESCHEDULE
submit_reschedule_request = () => {
    const requestReschduleCheck = [];
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();

    {{-- $('.selected-schedules').each(function() {
        if($(this).is(":checked")) {
            requestReschduleCheck.push($(this).val());
        }
    }); --}}

    // FORM PAYLOAD
    var formData = new FormData($("#requestRescheduleForm")[0]);
    {{-- formData.append('requestReschduleCheck', requestReschduleCheck); --}}

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
        url: "{{ route('student.request.reschedule') }}",
        type: 'post',
        data: formData, 
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#btnrequestReschdule').attr('disabled', 'disabled');
            $('#requestReschduleSpinner').removeClass('d-none');
        },
        success: function(data) {
            console.log('Success in request reschedule ajax.');
            $('#btnrequestReschdule').removeAttr('disabled', 'disabled');
            $('#requestReschduleSpinner').addClass('d-none');
            if(data['errors']) {
                console.log('Errors in validating data.');
                $.each(data['errors'], function(key, value) {
                    $('#'+key+'-err').show();
                    $('#'+key).addClass('is-invalid');
                    $('#'+key+'-err').append('<strong>'+value+'</strong>');
                });
            }else if(data['status'] == 'unselected'){
                $('#requestReschduleCheck-err').show();
                $('#requestReschduleCheck-err').append('<strong>Select one or more Schedules</strong>');
            }else if(data['status'] == 'success'){
                console.log('Success in select exam.');
                SwalDoneSuccess.fire({
                    title: 'Success!',
                    text: 'Selected exams have been applied.',
                })
                .then((result) => {
                    if(result.isConfirmed) {
                        location.reload();
                    }
                });
            }else{
                console.log('Error in request reschedule controller.');
                SwalSystemErrorDanger.fire();
            }

        },
        error: function(err) {
            console.log('Error in request reschedule ajax.');
            $('#btnrequestReschdule').removeAttr('disabled', 'disabled');
            $('#requestReschduleSpinner').addClass('d-none');
            SwalSystemErrorDanger.fire();
        }
    });


}
// /REQUEST RESCHEDULE



</script>