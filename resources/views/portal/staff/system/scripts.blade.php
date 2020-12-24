<script type="text/javascript">
// USER ROLE
  // ROLE NAME EDITABILITY
  InputRoleName_editable = () => {
    if($('#InputRoleName').attr('disabled')){
      $('#InputRoleName').removeAttr('disabled');
    }
    else{
      document.getElementById('InputRoleName').setAttribute("disabled","disabled");
    }
  }
  function InputRoleName_readonly() {
    document.getElementById('InputRoleName').setAttribute("disabled","disabled");
  }
  // /ROLE NAME EDITABILITY

  // CREATE
  create_role = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Form Payload
        var formData = new FormData($("#formUserRole")[0]);
        // var formData = new FormData();
        // //Add data
        // formData.append('inputNewRoleName', $('#inputNewRoleName').val())
        // formData.append('inputNewRoleDescription', $('#inputNewRoleDescription').val())

        //Validate information
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/create-user-role') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateUserRole').attr('disabled','disabled');},
          success: function(data){
            $('#btnCreateUserRole').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('errors on validating data');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
              //SwalCancelWarning.fire({title: 'Role creation Aborted!',text: 'You have no permission to create a role',})
            }
            else if(data['status'] == 'success'){
              console.log('create role ajax success');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'User role created.',
                })
                $('#modal-create-role').modal('hide')
                location.reload();
            }
          },
          error: function(err){
            $('#btnCreateUserRole').removeAttr('disabled','disabled');
            console.log('error in create role ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'User role creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  edit_role = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'User role has been updated.',
        })
        $('#modal-edit-role').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'User role has not been updated.',
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_role = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'User role has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'User role has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /USER ROLE

// PERMISSION
  // CREATE
  create_permission = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Permission created.',
        })
        $('#modal-create-permission').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Permission has not been created.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  edit_permission = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Permission has been updated.',
        })
        $('#modal-edit-permission').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Permission has not been updated.',
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_permission = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Permission has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Permission has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /PERMISSION

// SUBJECT
  // CREATE
  create_subject = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Subject created.',
        })
        $('#modal-create-subject').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been created.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  edit_subject = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Subject has been updated.',
        })
        $('#modal-edit-subject').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been updated.',
        })
      }
    })
  }
  // /EDIT

  //DELETE
  delete_subject = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Subject has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /SUBJECT

// EXAM_TYPE
  // CREATE
  create_exam_type = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Exam Type created.',
        })
        $('#modal-create-exam-type').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam Type has not been created.',
        })
      }
    })
  }
  // /CREATE
  // EDIT
  edit_exam_type = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Exam type has been updated.',
        })
        $('#modal-edit-exam-type').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been updated.',
        })
      }
    })
  }
  // /EDIT
  //DELETE
  delete_exam_type = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Exam type has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam type has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /EXAM_TYPE

// ACADEMIC YEAR
  // CREATE
  create_academic_year = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Academic Year created.',
        })
        $('#modal-create-academic-year').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Academic Year has not been created.',
        })
      }
    })
  }
  // /CREATE
  // EDIT
  edit_academic_year = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Academic year has been updated.',
        })
        $('#modal-edit-academic-year').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Academic year has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_academic_year = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Academic year has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Academic year has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /ACADEMIC YEAR

// STUDENT PHASE
  // CREATE
  create_student_phase = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Student Phase created.',
        })
        $('#modal-create-student-phase').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Student Phase has not been created.',
        })
      }
    })
  }
  // /CREATE
  // EDIT
  edit_student_phase = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Student phase has been updated.',
        })
        $('#modal-edit-student-phase').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Student phase has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_student_phase = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Student phase has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Student phase has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /STUDENT PHASE

// PAYMENT METHOD
  // CREATE
  create_payment_method = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Payment method created.',
        })
        $('#modal-create-payment-method').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment method has not been created.',
        })
      }
    })
  }
  // /CREATE
  // EDIT
  edit_payment_method = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Payment method has been updated.',
        })
        $('#modal-edit-payment-method').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment method has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_payment_method = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Payment method has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment method has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /PAYMENT METHOD

// PAYMENT TYPE
  // CREATE
  create_payment_type = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Payment type created.',
        })
        $('#modal-create-payment-type').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment type has not been created.',
        })
      }
    })
  }
  // /CREATE
  // EDIT
  edit_payment_type = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Updated!',
          text: 'Payment type has been updated.',
        })
        $('#modal-edit-payment-type').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment type has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_payment_type = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Payment type has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment type has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /PAYMENT TYPE
</script>