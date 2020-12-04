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
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'User role created.',
        })
        $('#modal-create-role').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'User role has not been created.',
        })
        $('#modal-create-role').modal('hide')
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
        $('#modal-edit-role').modal('hide')
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
        $('#modal-create-permission').modal('hide')
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
        $('#modal-edit-permission').modal('hide')
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
        $('#modal-create-subject').modal('hide')
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
        $('#modal-edit-subject').modal('hide')
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
        $('#modal-create-exam-type').modal('hide')
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
        $('#modal-edit-exam-type').modal('hide')
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
        $('#modal-create-academic-year').modal('hide')
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
        $('#modal-edit-academic-year').modal('hide')
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
        $('#modal-create-student-phase').modal('hide')
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
        $('#modal-edit-student-phase').modal('hide')
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
</script>