<script type="text/javascript">

// INVOKE APPLICANT INFORMATION MODAL
view_modal_applicant = (registration_id) => {
  // PAYLOAD
  var formData = new FormData();
  formData.append('registration_id',registration_id);

  // GET DETAILS
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "{{ route('student.application.applicantInfo') }}",
    type: 'post',
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function(){
      $('#btnViewModalApplicant-'+registration_id).attr('disabled','disabled');
      $('#spinnerBtnViewModalApplicant-'+registration_id).removeClass('d-none');
    },
    success: function(data){
      console.log('Success in invoke applicant modal get detials ajax.');
      if(data['status'] == 'success'){
        var date = new Date(data['registration']['created_at']);
        $('#spanSubmittedOn').html(date.toLocaleDateString());
        $('#spanTitle').html(data['student']['title']);

        //APPLICATION
        $('#spanFirstName').html(data['student']['first_name']);
        $('#spanMiddleNames').html(data['student']['middle_names']);
        $('#spanInitials').html(data['student']['initials']);
        $('#spanLastName').html(data['student']['last_name']);
        $('#spanFullName').html(data['student']['full_name']);
        if(data['student']['gender'] == 'Male'){$('#iconGender').addClass('fa-male'); $('#spanGender').html('(Male)');}else{$('#iconGender').addClass('fa-female'); $('#spanGender').html('(Female)');};
        $('#spanDOB').html(new Date(data['student']['dob']).toLocaleDateString());
        $('#spanCitizenship').html(data['student']['citizenship']);
        //set IDs
        $('.trIDs').remove();
        if(data['student']['nic_old'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>NIC (old):</th><td>'+ data['student']['nic_old'] +'</td></tr>');}
        if(data['student']['nic_new'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>NIC (new):</th><td>'+ data['student']['nic_new'] +'</td></tr>');}
        if(data['student']['postal'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>Postal ID:</th><td>'+ data['student']['postal'] +'</td></tr>');}
        if(data['student']['passport'] != null){$("#tblPersonal").append('<tr class="trIDs"><th>Passport ID:</th><td>'+ data['student']['passport'] +'</td></tr>');}
        
        $('#spanEducation').html(data['student']['education']);

        //permanent address
        $('#spanHouseNo').html(data['student']['permanent_house']);
        $('#spanAddress1').html(data['student']['permanent_address_line1']);
        $('#spanAddress2').html(data['student']['permanent_address_line2']);
        $('#spanAddress3').html(data['student']['permanent_address_line3']);
        $('#spanAddress4').html(data['student']['permanent_address_line4']);
        $('#spanCity').html(data['permanentAddressDetails']['permanentCity']);
        $('#spanState').html(data['permanentAddressDetails']['permanentState']);
        $('#spanCountry').html(data['permanentAddressDetails']['permanentCountry']);

        //current address
        $('#spanCurrentHouseNo').html(data['student']['current_house']);
        $('#spanCurrentAddress1').html(data['student']['current_address_line1']);
        $('#spanCurrentAddress2').html(data['student']['current_address_line2']);
        $('#spanCurrentAddress3').html(data['student']['current_address_line3']);
        $('#spanCurrentAddress4').html(data['student']['current_address_line4']);
        $('#spanCurrentCity').html(data['currentAddressDetails']['currentCity']);
        $('#spanCurrentState').html(data['currentAddressDetails']['currentState']);
        $('#spanCurrentCountry').html(data['currentAddressDetails']['currentCountry']);

        $('#spanTelephoneCode').html(data['student']['telephone_country_code']);
        $('#spanTelephone').html(data['student']['telephone']);
        $('#spanEmail').html(data['email']);
        $('#spanDesignation').html(data['student']['designation']);
        
        //BUTTONS
        if(data['registration']['application_status'] == 'Approved'){
          $('#iconDetailStatus').addClass('fa-check-circle text-success');
          $('#divBtnApproveApplication').addClass('d-none');
          $('#btnDeclineApplicationModal').attr('onclick', 'decline_application('+registration_id+')');
        }
        else if(data['registration']['application_status'] == 'Declined'){
          $('#iconDetailStatus').addClass('fa-times-circle text-danger');
          $('#divBtnDeclineApplication').addClass('d-none');
          $('#btnApproveApplication').attr('onclick', 'approve_application('+registration_id+')');
        }
        else{
          $('#iconDetailStatus').addClass('fa-exclamation-triangle text-main-theme-warning');
          $('#btnApproveApplication').attr('onclick', 'approve_application('+registration_id+')');
          $('#btnDeclineApplicationModal').attr('onclick', 'decline_application('+registration_id+')');
        }
        // /APPLICATION

        // PAYMENT
        if(data['payment'] != null){
          $('#spanPaymentDate').html(data['payment']['details']['paid_date']);
          $('#spanPaymentBank').html(data['payment']['bank']['name']);
          $('#spanPaymentBankBranch').html(data['payment']['bankBranch']['name']);
          $('#spanPaymentBankBranchCode').html(data['payment']['bankBranch']['code']);
          $('#spanPaymentAmount').html(data['payment']['details']['amount']);
          $('#imgPaymentBankSlip').attr('style', 'background: url(/storage/payments/registration/'+data['student']['id']+'/'+data['payment']['details']['image']+')');
          $('#imgPaymentBankSlip').attr('onclick', 'window.open("/storage/payments/registration/'+data['student']['id']+'/'+data['payment']['details']['image']+'")');
          
          //BUTTONS
          if(data['registration']['payment_status'] == 'Approved'){
            $('#iconPaymentStatus').addClass('fa-check-circle text-success');
            $('#divBtnApprovePayment').addClass('d-none');
            $('#btnDeclinePaymentModal').attr('onclick', 'decline_payment('+registration_id+')');
          }
          else if(data['registration']['payment_status'] == 'Declined'){
            $('#iconPaymentStatus').addClass('fa-times-circle text-danger');
            $('#divBtnDeclinePayment').addClass('d-none');
            $('#btnApprovePayment').attr('onclick', 'approve_payment('+registration_id+')');
          }
          else{
            $('#iconPaymentStatus').addClass('fa-exclamation-triangle text-main-theme-warning');
            $('#btnApprovePayment').attr('onclick', 'approve_payment('+registration_id+')');
            $('#btnDeclinePaymentModal').attr('onclick', 'decline_payment('+registration_id+')');
          }
        }
        // /PAYMENT

        //DOCUMENTS
        if(data['documents'] != null){
          $('#imgBirthFront').attr('style', 'background: url(/storage/students/'+data['student']['id']+'/'+data['documents']['bcFront']+')');
          $('#imgBirthBack').attr('style', 'background: url(/storage/students/'+data['student']['id']+'/'+data['documents']['bcBack']+')');
          $('#imgIdFront').attr('style', 'background: url(/storage/students/'+data['student']['id']+'/'+data['documents']['idFront']+')');
          $('#imgIdBack').attr('style', 'background: url(/storage/students/'+data['student']['id']+'/'+data['documents']['idBack']+')');

          $('#imgBirthFront').attr('onclick', 'window.open("/storage/students/'+data['student']['id']+'/'+data['documents']['bcFront']+'")');
          $('#imgBirthBack').attr('onclick', 'window.open("/storage/students/'+data['student']['id']+'/'+data['documents']['bcBack']+'")');
          $('#imgIdFront').attr('onclick', 'window.open("/storage/students/'+data['student']['id']+'/'+data['documents']['idFront']+'")');
          $('#imgIdBack').attr('onclick', 'window.open("/storage/students/'+data['student']['id']+'/'+data['documents']['idBack']+'")');

          if(data['student']['nic_old']){
            $('#spanIdType').html('NIC');
            $('#spanIdentity').html(data['student']['nic_old']);
          }
          else if(data['student']['nic_new']){
            $('#spanIdType').html('NIC');
            $('#spanIdentity').html(data['student']['nic_new']);
          }
          else if(data['student']['postal']){
            $('#spanIdType').html('Postal ID');
            $('#spanIdentity').html(data['student']['postal']);
          }
          else if(data['student']['passport']){
            $('#spanIdType').html('Passport ID');
            $('#spanIdentity').html(data['student']['passport']);
          }

          //BUTTONS
          if(data['registration']['document_status'] == 'Approved'){
            $('#iconDocumentsStatus').addClass('fa-check-circle text-success');
            $('#divBtnApproveDocuments').addClass('d-none');
            $('#btnDeclineDocumentBirthModal').attr('onclick', 'decline_documentBirth('+registration_id+')');
            $('#btnDeclineDocumentIdModal').attr('onclick', 'decline_documentId('+registration_id+')');
          }
          else if(data['registration']['document_status'] == 'Declined'){
            $('#iconDocumentsStatus').addClass('fa-times-circle text-danger');
            $('#divBtnDeclineDocumentBirth').addClass('d-none');
            $('#divBtnDeclineDocumentId').addClass('d-none');
            $('#btnApproveDocuments').attr('onclick', 'approve_documents('+registration_id+')');
          }
          else{
            $('#iconDocumentsStatus').addClass('fa-exclamation-triangle text-main-theme-warning');
            $('#btnApproveDocuments').attr('onclick', 'approve_documents('+registration_id+')');
            $('#btnDeclineDocumentBirthModal').attr('onclick', 'decline_documentBirth('+registration_id+')');
            $('#btnDeclineDocumentIdModal').attr('onclick', 'decline_documentId('+registration_id+')');
          }
        }
        // /DOCUMENTS
        $('#spinnerBtnViewModalApplicant-'+registration_id).addClass('d-none');
        $('#btnViewModalApplicant-'+registration_id).removeAttr('disabled','disabled');
        $('#modal-view-applicant').modal('show');
      }
    },
    error: function(err){
      console.log('Error in invoke applicant modal get detials ajax.');
      $('#spinnerBtnViewModalApplicant-'+registration_id).addClass('d-none');
      $('#btnViewModalApplicant-'+registration_id).attr('disabled','disabled');
      SwalSystemErrorDanger.fire();
    }
  });
}
// /INVOKE APPLICANT INFORMATION MODAL

// APPROVE APPLICATION
approve_application = (registration_id) => {
  SwalQuestionWarningAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Approve!',
  })
  .then((result) => {
    if(result.isConfirmed) {

      // FORM PAYLOAD
      var formData = new FormData();
      formData.append('registration_id', registration_id)

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('student.application.approveApplication') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,           
        beforeSend: function(){
          // Show loader
          $("#spinnerBtnApproveApplication").removeClass('d-none');
          $('#btnApproveApplication').attr('disabled','disabled');
        },
        success: function(data){
          console.log('Approve Application Ajax Success');
          $("#spinnerBtnApproveApplication").addClass('d-none');
          $('#btnApproveApplication').removeAttr('disabled');
          if (data['status'] == 'success'){
            SwalDoneSuccess.fire({
              title: 'Approved!',
              text: 'Application approved successfully',
            }).then((result) => {
              if(result.isConfirmed) {
                location.reload()
              }
            });
          }else{
            SwalSystemErrorDanger.fire({
              title: 'Application Approve Process Failed!',
            })
          }
        },
        error: function(err){
          console.log('Approve Application Error');
          $("#spinnerBtnApproveApplication").addClass('d-none');
          $('#btnApproveApplication').removeAttr('disabled');
          SwalSystemErrorDanger.fire({
            title: 'Approve Process Failed!',
          })
        }
      });
    }
    else{
      SwalNotificationWarningAutoClose.fire({
        title: 'Aborted!',
        text: 'Application approval process aborted.',
      })
    }
  })
}
// /APPROVE APPLICATION

// DECLINE APPLICATION
decline_application = (registration_id) => {
  SwalQuestionWarningAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Decline!',
  })
  .then((result) => {
    if(result.isConfirmed) {

      // FORM PAYLOAD
      var formData = new FormData();
      formData.append('registration_id', registration_id)
      formData.append('declined_msg', $('#declineMessageApplication').val())

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('student.application.declineApplication') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,           
        beforeSend: function(){
          // Show loader
          $("#spinnerBtnDeclineApplication").removeClass('d-none');
          $('#btnDeclineApplication').attr('disabled','disabled');
        },
        success: function(data){
          console.log('Decline Application Ajax Success');
          $("#spinnerBtnDeclineApplication").addClass('d-none');
          $('#btnDeclineApplication').removeAttr('disabled');
          if (data['status'] == 'success'){
            SwalDoneSuccess.fire({
              title: 'Declined!',
              text: 'Application declined successfully',
            }).then((result) => {
              if(result.isConfirmed) {
                location.reload()
              }
            });
          }else{
            SwalSystemErrorDanger.fire({
              title: 'Application Decline Process Failed!',
            })
          }
        },
        error: function(err){
          console.log('Decline Application Error');
          $("#spinnerBtnDeclineApplication").addClass('d-none');
          $('#btnDeclineApplication').removeAttr('disabled');
          SwalSystemErrorDanger.fire({
            title: 'Decline Process Failed!',
          })
        }
      });
    }
    else{
      SwalNotificationWarningAutoClose.fire({
        title: 'Aborted!',
        text: 'Application decline process aborted.',
      })
    }
  })
}
// /DECLINE APPLICATION

// APPROVE PAYMENT
approve_payment = (registration_id) => {
  SwalQuestionWarningAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Approve!',
  })
  .then((result) => {
    if(result.isConfirmed) {

      // FORM PAYLOAD
      var formData = new FormData();
      formData.append('registration_id', registration_id)

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('student.application.approvePayment') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,           
        beforeSend: function(){
          // Show loader
          $("#spinnerBtnApprovePayment").removeClass('d-none');
          $('#btnApprovePayment').attr('disabled','disabled');
        },
        success: function(data){
          console.log('Approve Payment Ajax Success');
          $("#spinnerBtnApprovePayment").addClass('d-none');
          $('#btnApprovePayment').removeAttr('disabled');
          if (data['status'] == 'success'){
            SwalDoneSuccess.fire({
              title: 'Approved!',
              text: 'Payment approved successfully',
            }).then((result) => {
              if(result.isConfirmed) {
                location.reload()
              }
            });
          }else{
            SwalSystemErrorDanger.fire({
              title: 'Payment Approve Process Failed!',
            })
          }
        },
        error: function(err){
          console.log('Approve Payment Error');
          $("#spinnerBtnApprovePayment").addClass('d-none');
          $('#btnApprovePayment').removeAttr('disabled');
          SwalSystemErrorDanger.fire({
            title: 'Payment Approve Process Failed!',
          })
        }
      });
    }
    else{
      SwalNotificationWarningAutoClose.fire({
        title: 'Aborted!',
        text: 'Payment approval process aborted.',
      })
    }
  })
}
// /APPROVE PAYMENT

// DECLINE PAYMENT
decline_payment = (registration_id) => {
  SwalQuestionWarningAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Decline!',
  })
  .then((result) => {
    if(result.isConfirmed) {

      // FORM PAYLOAD
      var formData = new FormData();
      formData.append('registration_id', registration_id)
      formData.append('declined_msg', $('#declineMessagePayment').val())

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('student.application.declinePayment') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,           
        beforeSend: function(){
          // Show loader
          $("#spinnerBtnDeclinePayment").removeClass('d-none');
          $('#btnDeclinePayment').attr('disabled','disabled');
        },
        success: function(data){
          console.log('Decline Payment Ajax Success');
          $("#spinnerBtnDeclinePayment").addClass('d-none');
          $('#btnDeclinePayment').removeAttr('disabled');
          if (data['status'] == 'success'){
            SwalDoneSuccess.fire({
              title: 'Declined!',
              text: 'Payment declined successfully',
            }).then((result) => {
              if(result.isConfirmed) {
                location.reload()
              }
            });
          }else{
            SwalSystemErrorDanger.fire({
              title: 'Payment Decline Process Failed!',
            })
          }
        },
        error: function(err){
          console.log('Decline Payment Error');
          $("#spinnerBtnDeclinePayment").addClass('d-none');
          $('#btnDeclinePayment').removeAttr('disabled');
          SwalSystemErrorDanger.fire({
            title: 'Payment Decline Process Failed!',
          })
        }
      });
    }
    else{
      SwalNotificationWarningAutoClose.fire({
        title: 'Aborted!',
        text: 'Payment decline process aborted.',
      })
    }
  })
}
// /DECLINE PAYMENT

</script>