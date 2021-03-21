<script type="text/javascript">

// INVOKE MEDICAL MODAL
view_modal_medical =(applied_medical_id) => {

    // Form Payload
    var formData = new FormData();
    formData.append('applied_medical_id', applied_medical_id);

    // Get medical details controller
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('student.exams.medical.details') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#btnViewModalAppliedMedical-'+applied_medical_id).attr('disabled', 'disabled');
            $('#spinnerBtnViewModalAppliedMedical-'+applied_medical_id).removeClass('d-none');
        },
        success: function(data) {
            console.log('Success in get medical details ajax.');
            if(data['status'] == 'success') {
                //Student Details
                $('#spanStudentName').html(data['student']['initials'] + ' ' + data['student']['last_name']);
                $('#spanRegNumber').html(data['student']['reg_no']);

                // Medical details
                if(data['medical'] != null) {
                    var date = new Date(data['medical']['updated_at']);
                    $('#medicalId').val(data['medical']['id']);
                    $('#spanSubmittedOn').html(date.toLocaleDateString());
                    $('#spanSubject').html('FIT ' + data['medical']['subject_code'] + ' - '+ data['medical']['subject_name']);
                    $('#spanExamType').html(data['medical']['exam_type']);
                    $('#spanExamHeldDate').html(data['medical']['held_date']);
                    $('#spanMedicalReason').html(data['medical']['medical_reason']);
                    $('#imgMedical').attr('style', 'background: url(/storage/medicals/'+data['student']['id']+'/'+data['medical']['medical_image']+')');
                    $('#imgMedical').attr('onclick', 'window.open("/storage/medicals/'+data['student']['id']+'/'+data['medical']['medical_image']+'")');

                    $('#btnViewModalAppliedMedical-'+applied_medical_id).removeAttr('disabled', 'disabled');
                    $('#spinnerBtnViewModalAppliedMedical-'+applied_medical_id).addClass('d-none');
                    $('#modal-medical').modal('show');
                }
            }
        },
        error: function(err) {
            console.log('Error in get medical details ajax.');
            $('#btnViewModalAppliedMedical-'+applied_medical_id).removeAttr('disabled', 'disabled');
            $('#spinnerBtnViewModalAppliedMedical-'+applied_medical_id).addClass('d-none');
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
                            title: 'Medical Approve Process Failed!',
                        })
                    }
                },
                error: function(err) {
                    console.log('Approve medical ajax error');
                    $("#spinnerBtnApproveMedical").addClass('d-none');
                    $('#btnApproveMedical').removeAttr('disabled', 'disabled');
                    SwalSystemErrorDanger.fire({
                        title: 'Medical Approve Process Failed!',
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

</script>