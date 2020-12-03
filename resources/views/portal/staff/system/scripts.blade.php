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

  // EDIT
  edit_role = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_success,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_success,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Updated!',
          text: 'Permissions has been updated.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
        $('#modal-edit-role').modal('hide')
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Permissions has not been updated.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
        $('#modal-edit-role').modal('hide')
      }
    })
  }
  // /EDIT

  // DELETE
  delete_role = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_danger,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_danger,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'User Role has been deleted.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'User Role has not been deleted.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /USER ROLE

// PERMISSION
  // EDIT
  edit_permission = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_success,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_success,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Updated!',
          text: 'Permission has been updated.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
        $('#modal-edit-permission').modal('hide')
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Permission has not been updated.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
        $('#modal-edit-permission').modal('hide')
      }
    })
  }
  // /EDIT

  // DELETE
  delete_permission = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_danger,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_danger,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'Permission has been deleted.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Permission has not been deleted.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /PERMISSION

// SUBJECT
  // EDIT
  edit_subject = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_success,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_success,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Updated!',
          text: 'Subject has been updated.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
        $('#modal-edit-subject').modal('hide')
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Subject has not been updated.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
        $('#modal-edit-subject').modal('hide')
      }
    })
  }
  // /EDIT

  //DELETE
  delete_subject = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'warning',
    iconColor: sweetalert_danger,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_danger,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'Subject has been deleted.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Subject has not been deleted.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /SUBJECT

// EXAM_TYPE
  // EDIT
  edit_exam_type = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_success,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_success,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Updated!',
          text: 'Exam type has been updated.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
        $('#modal-edit-exam-type').modal('hide')
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Subject has not been updated.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
        $('#modal-edit-exam-type').modal('hide')
      }
    })
  }
  // /EDIT

  //DELETE
  delete_exam_type = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'warning',
    iconColor: sweetalert_danger,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_danger,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'Exam type has been deleted.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Exam type has not been deleted.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /EXAM_TYPE

// ACADEMIC YEAR
  // EDIT
  edit_academic_year = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_success,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_success,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Updated!',
          text: 'Academic year has been updated.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
        $('#modal-edit-academic-year').modal('hide')
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Academic year has not been updated.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
        $('#modal-edit-academic-year').modal('hide')
      }
    })
  }
  // /EDIT

  // DELETE
  delete_academic_year = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'warning',
    iconColor: sweetalert_danger,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_danger,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'Academic year has been deleted.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Academic year has not been deleted.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /ACADEMIC YEAR

// STUDENT STAGE
  // EDIT
  edit_student_stage = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_success,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_success,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Updated!',
          text: 'Student stage has been updated.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
        $('#modal-edit-student-stage').modal('hide')
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Student stage has not been updated.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
        $('#modal-edit-student-stage').modal('hide')
      }
    })
  }
  // /EDIT

  // DELETE
  delete_student_stage = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'warning',
    iconColor: sweetalert_danger,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_danger,
    showCancelButton: true,
    cancelButtonColor: sweetalert_primary,
    timer: 5000,
    timerProgressBar: true,
    allowOutsideClick: false,
    })
    .then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Deleted!',
          text: 'Student stage has been deleted.',
          icon: 'success',
          confirmButtonColor: sweetalert_success,
          allowOutsideClick: false,
        })
      }
      else{
        Swal.fire({
          title: 'Cancelled!',
          text: 'Student stage has not been deleted.',
          icon: 'warning',
          iconColor: sweetalert_warning,
          confirmButtonColor: sweetalert_warning,
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /STUDENT STAGE
</script>