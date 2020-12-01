<script type="text/javascript">
// USER ROLE
  // EDIT
  edit_role = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_warning,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_warning,
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
          allowOutsideClick: false,
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_role = () => {
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
          text: 'User Role has been deleted.',
          icon: 'success',
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
    iconColor: sweetalert_warning,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_warning,
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
          allowOutsideClick: false,
        })
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
    iconColor: sweetalert_warning,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_warning,
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
          allowOutsideClick: false,
        })
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
          text: 'Examp type has been deleted.',
          icon: 'success',
          allowOutsideClick: false,
        })
      }
    })
  }
  // /DELETE
// /EXAM_TYPE
</script>