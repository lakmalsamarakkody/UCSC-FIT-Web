<script type="text/javascript">

// INVOKE MEDICAL MODAL
view_modal_reschedule_request =(payment_id) => {

    // Form Payload
    var formData = new FormData();
    formData.append('payment_id', payment_id);

    // Get medical details controller
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('student.exams.reschedule.request.details') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#btnViewModalRescheduleRequest-'+payment_id).attr('disabled', 'disabled');
            $('#spinnerbtnViewModalRescheduleRequest-'+payment_id).removeClass('d-none');
        },
        success: function(data) {
            console.log('Success in get reschedule request details ajax.');
            $('#btnViewModalRescheduleRequest-'+payment_id).removeAttr('disabled', 'disabled');
            $('#spinnerbtnViewModalRescheduleRequest-'+payment_id).addClass('d-none');
            if(data['status'] == 'success') {
                console.log('Success in get reschedule request details.');
                //Student Details
                $('#spanStudentName').html(data['student']['initials'] + ' ' + data['student']['last_name']);
                $('#spanRegNumber').html(data['student']['reg_no']);

                // Reschedule request details
                if(data['medical'] != null && data['payment'] != null) {
                    var requestedDate = new Date(data['payment']['created_at']);
                    $('#spanRequestedOn').html(requestedDate.toLocaleDateString());

                    // Buttons
                    if(data['payment']['status'] == 'Approved'){
                        $('#iconPaymentStatus').addClass('fa-check-circle text-success');
                        $('#divBtnApprovePayment').addClass('d-none');
                        $('#divBtnDeclinePayment').addClass('d-none');
                        $('#divBtnAssignAppliedExams').removeClass('d-none');
                    }
                    else if(data['payment']['status'] == 'Declined'){
                        $('#iconPaymentStatus').addClass('fa-times-circle text-danger');
                        $('#divBtnApprovePayment').addClass('d-none');
                        $('#divBtnDeclinePayment').addClass('d-none');
                    }
                    else{
                        $('#iconPaymentStatus').removeClass('d-none');
                        $('#divBtnApprovePayment').removeClass('d-none');
                        $('#divBtnDeclinePayment').removeClass('d-none');
                        $('#iconPaymentStatus').addClass('fa-exclamation-triangle text-main-theme-warning');
                    }

                    //show requested exams
                    var requestedExams = '';
                    $.each(data['exams'], function(key, value) {
                        requestedExams += '<tr class="trRequestedExams">';
                        requestedExams += '<td>FIT '+ value.subject_code +'</td>';
                        requestedExams += '<td>'+ value.subject_name +'</td>';
                        requestedExams += '<td>'+ value.exam_type +'</td>';
                        requestedExams += '<td>'+ value.date +'</td>';
                        requestedExams += '<td>'+ value.time +'</td>';
                        requestedExams += '</tr>';
                    })
                    $('#requestedExamstbl tbody').html(requestedExams);
                    // /show requested exams

                    
                    $('#spanReason').html(data['medical']['reason']!='No File');
                    if(data['medical']['image']){
                        $('#imgRecheduleReasonDocument').attr('style', 'background: url(/storage/reschedules/'+data['student']['id']+'/'+data['medical']['image']+')');
                        $('#imgRecheduleReasonDocument').attr('onclick', 'window.open("/storage/reschedules/'+data['student']['id']+'/'+data['medical']['image']+'")'); 
                    }else {
                        $('#imgRecheduleReasonDocument').html('No Document Uploaded')
                    }

                    var paymentDate = new Date(data['payment']['paid_date']);
                    $('#spanPaymentDate').html(paymentDate.toLocaleDateString());
                    $('#spanPaymentBank').html(data['payment']['bank']);
                    $('#spanPaymentBankBranch').html(data['payment']['bank_branch']);
                    $('#spanPaymentBankBranchCode').html(data['payment']['bank_branch_code']);
                    $('#spanPaymentAmount').html(data['payment']['amount']);
                    $('#imgExamPaymentBankSlip').attr('style', 'background: url(/storage/payments/reschedules/'+data['student']['id']+'/'+data['payment']['image']+')');
                    $('#imgExamPaymentBankSlip').attr('onclick', 'window.open("/storage/payments/reschedules/'+data['student']['id']+'/'+data['payment']['image']+'")'); 
                    
                    $('#btnApprovePayment').attr('onclick', 'approve_payment('+data['payment']['id']+')'); 
                    $('#btnDeclineResubmit').attr('onclick', 'resubmission_enable_decline('+data['payment']['id']+')'); 
                    $('#btnDeclinePayment').attr('onclick', 'decline_payment('+data['payment']['id']+')'); 

                    $('#modal-view-reschedule-request').modal('show');
                }
            }
        },
        error: function(err) {
            console.log('Error in get reschedule request details ajax.');
            $('#btnViewModalRescheduleRequest-'+payment_id).removeAttr('disabled', 'disabled');
            $('#spinnerbtnViewModalRescheduleRequest-'+payment_id).addClass('d-none');
            SwalSystemErrorDanger.fire();
        }
    });
}
// /INVOKE MEDICAL MODAL

// APPROVE PAYMENT
approve_payment = (payment_id) => {
    SwalQuestionWarningAutoClose.fire({
        title: "Are you sure?",
        text: "You wont be able to revert this!",
        confirmButtonText: 'Yes, Approve!',
    })
    .then((result) => {
        if(result.isConfirmed) {

            // Form Payload
            var formData = new FormData();
            formData.append('payment_id', payment_id);

            // Approve medical controller
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('student.exams.medical.approve') }}",
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,           
                beforeSend: function(){
                    $("#spinnerBtnApprovePayment").removeClass('d-none');
                    $('#btnApprovePayment').attr('disabled','disabled'); 
                    $('#btnDeclineResubmit').attr('disabled','disabled'); 
                    $('#btnDeclinePayment').attr('disabled','disabled');    
                },
                success: function(data){
                    console.log('Approve medical ajax success.');
                    $("#spinnerBtnApprovePayment").addClass('d-none');
                    $('#btnApprovePayment').removeAttr('disabled', 'disabled');
                    $('#btnDeclineResubmit').removeAttr('disabled','disabled'); 
                    $('#btnDeclinePayment').removeAttr('disabled','disabled');  
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
                    $("#spinnerBtnApprovePayment").addClass('d-none');
                    $('#btnApprovePayment').removeAttr('disabled', 'disabled');
                    $('#btnDeclineResubmit').removeAttr('disabled','disabled'); 
                    $('#btnDeclinePayment').removeAttr('disabled','disabled');  
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
// /APPROVE PAYMENT

// DECLINE PAYMENT
decline_medical = (payment_id) => {
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
                data: {'payment_id': payment_id},
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
// /DECLINE PAYMENT


// RESUBMISSION ENABLE DECLINE
resubmission_enable_decline = (payment_id) => {
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
                data: {'message': result.value, 'payment_id': payment_id},
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