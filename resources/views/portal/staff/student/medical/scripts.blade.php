<script type="text/javascript">

// INVOKE MEDICAL MODAL
view_modal_medical =(medical_id) => {

    // Form Payload
    var formData = new FormData();
    formData.append('medical_id', medical_id);

    // Get medical details controller
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('student.exams.medical.details') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#btnViewModalAppliedMedical-'+medical_id).attr('disabled', 'disabled');
            $('#spinnerBtnViewModalAppliedMedical-'+medical_id).removeClass('d-none');
        },
        success: function(data) {
            console.log('Success in get medical details ajax.');
            if(data['status'] == 'success') {
                //Student Details
                $('#spanStudentName').html(data['student']['initials'] + ' ' + data['student']['last_name']);
                $('#spanRegNumber').html(data['student']['reg_no']);

                // Medical details
                if(data['medical'] != null && data['exam'] != null) {
                    var date = new Date(data['medical']['created_at']);
                    $('#spanSubmittedOn').html(date.toLocaleDateString());
                    $('#medicalId').val(data['medical']['id']);
                    $('#spanSubject').html('FIT ' + data['exam']['subject_code'] + ' - '+ data['exam']['subject_name']);
                    $('#spanExamType').html(data['exam']['exam_type']);
                    $('#spanExamHeldDate').html(data['exam']['held_date']);
                    $('#spanMedicalReason').html(data['medical']['reason']);
                    $('#imgMedical').attr('style', 'background: url(/storage/medicals/'+data['student']['id']+'/'+data['medical']['image']+')');
                    $('#imgMedical').attr('onclick', 'window.open("/storage/medicals/'+data['student']['id']+'/'+data['medical']['image']+'")');

                    $('#btnViewModalAppliedMedical-'+medical_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnViewModalAppliedMedical-'+medical_id).addClass('d-none');
                    $('#modal-medical').modal('show');
                }
            }
        },
        error: function(err) {
            console.log('Error in get medical details ajax.');
            $('#btnViewModalAppliedMedical-'+medical_id).removeAttr('disabled', 'disabled');
            $('#spinnerBtnViewModalAppliedMedical-'+medical_id).addClass('d-none');
            SwalSystemErrorDanger.fire();
        }
    });
}
// /INVOKE MEDICAL MODAL

// APPROVE MEDICAL
approve_medical = () => {
    SwalQuestionWarningAutoClose.fire({
        title: "Are you sure?",
        text: "You wont be able to revert this!",
        confirmButtonText: 'Yes, Approve!',
    })
    .then((result) => {
        if(result.isConfirmed) {

            // Form Payload
            var formData = new FormData();
            formData.append('medical_id', $('#medicalId').val());

            // Approve medical controller
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('student.exams.medical.approve') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,           
                beforeSend: function(){
                    $("#spinnerBtnApproveMedical").removeClass('d-none');
                    $('#btnApproveMedical').attr('disabled','disabled');    
                },
                success: function(data){
                    console.log('Approve medical ajax success.');
                    $("#spinnerBtnApproveMedical").addClass('d-none');
                    $('#btnApproveMedical').removeAttr('disabled', 'disabled');
                    if (data['status'] == 'success'){
                        SwalDoneSuccess.fire({
                            title: 'Approved!',
                            text: 'Medical approved successfully',
                        }).then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                    else {
                        SwalSystemErrorDanger.fire({
                            title: 'Medical Approval Process Failed!',
                        })
                    }
                },
                error: function(err) {
                    console.log('Approve medical ajax error');
                    $("#spinnerBtnApproveMedical").addClass('d-none');
                    $('#btnApproveMedical').removeAttr('disabled', 'disabled');
                    SwalSystemErrorDanger.fire({
                        title: 'Medical Approval Process Failed!',
                    })
                }
            });
        }
        else {
            SwalNotificationWarningAutoClose.fire({
                title: 'Aborted!',
                text: 'Medical approval process aborted.',
            })
        }
    })
}
// /APPROVE MEDICAL

// DECLINE MEDICAL
decline_medical = () => {
    SwalQuestionDanger.fire({
        title: "Are you sure ?",
        text: "The medical will be declined",
        confirmButtonText: "Yes, Decline!",
    })
    .then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('student.exams.medical.decline') }}",
                type: 'post',
                data: {'medical_id': $('#medicalId').val()},
                beforeSend: function() {
                    $("#spinnerBtnDeclineMedical").removeClass('d-none');
                    $('#btnDeclineMedical').attr('disabled', 'disabled');
                    Swal.showLoading();
                },
                success: function(data) {
                    console.log('Success in decline medical ajax.');
                    $("#spinnerBtnDeclineMedical").addClass('d-none');
                    $('#btnDeclineMedical').removeAttr('disabled', 'disabled');
                    Swal.hideLoading();
                    if(data['status'] == 'error') {
                        console.log('Error in decline medical.');
                        SwalSystemErrorDanger.fire({
                            title: 'Decline Failed!',
                            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                        })
                    }
                    else if(data['status'] == 'success') {
                        console.log('Success in decline medical.');
                        SwalDoneSuccess.fire({
                            title: 'Declined!',
                            text: 'Medical has been Declined.'
                        })
                        .then((result2) => {
                            if(result2.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(err) {
                    console.log('Error in decline medical ajax.');
                    $("#spinnerBtnDeclineMedical").addClass('d-none');
                    $('#btnDeclineMedical').removeAttr('disabled', 'disabled');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
        else {
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Medical decline process aborted.',
            })
        }
    });
}
// /DECLINE MEDICAL


// RESUBMISSION ENABLE DECLINE
resubmission_enable_decline = () => {
    $(document).off('focusin.modal');
    SwalQuestionDanger.fire({
        title: "Reason to Decline ?",
        input: 'textarea',
        inputLabel: 'Message',
        inputPlaceholder: 'Type your message here...',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        inputValidator: (value) => {
            if(!value) {
                return 'You need to write something!'
            }
        },
        timer: false,
        showCancelButton: true,
        confirmButtonText: "Decline!",
    })
    .then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('student.exams.medical.resubmit.decline') }}",
                type: 'post',
                data: {'message': result.value, 'medical_id': $('#medicalId').val()},
                beforeSend: function() {
                    $("#spinnerBtnDeclineResubmit").removeClass('d-none');
                    $('#btnDeclineResubmit').attr('disabled', 'disabled');
                    Swal.showLoading();
                },
                success: function(data) {
                    console.log('Success in decline medical with resubmit ajax.');
                    $("#spinnerBtnDeclineResubmit").addClass('d-none');
                    $('#btnDeclineResubmit').removeAttr('disabled', 'disabled');
                    Swal.hideLoading();
                    if(data['status'] == 'error') {
                        console.log('Error in decline medical.');
                        SwalSystemErrorDanger.fire({
                            title: 'Decline Failed!',
                            text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                        })
                    }
                    else if(data['status'] == 'success') {
                        console.log('Success in decline medical with resubmit.');
                        SwalDoneSuccess.fire({
                            title: 'Declined!',
                            text: 'Medical has been Declined.'
                        })
                        .then((result1) => {
                            if(result1.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(err) {
                    console.log('Error in decline medical with resubmit ajax.');
                    $("#spinnerBtnDeclineResubmit").addClass('d-none');
                    $('#btnDeclineResubmit').removeAttr('disabled', 'disabled');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
        else {
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Medical decline process aborted.',
            })
        }
    });
}
// /RESUBMISSION ENABLE DECLINE
</script>