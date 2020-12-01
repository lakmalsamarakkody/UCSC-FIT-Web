<script type="text/javascript">
// USER ROLE
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
        $('#modal-edit-role').modal('toggle')
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
        $('#modal-edit-role').modal('toggle')
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
        $('#modal-edit-subject').modal('toggle')
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
        $('#modal-edit-subject').modal('toggle')
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
        $('#modal-edit-exam-type').modal('toggle')
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
        $('#modal-edit-exam-type').modal('toggle')
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
</script>