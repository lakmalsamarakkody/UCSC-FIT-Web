<script type="text/javascript">
// USER ROLE
  // EDIT
  edit_role = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'question',
    iconColor: sweetalert_red,
    confirmButtonText: 'Yes, Update!',
    confirmButtonColor: sweetalert_red,
    showCancelButton: true,
    cancelButtonColor: sweetalert_blue,
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
    iconColor: sweetalert_red,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_red,
    showCancelButton: true,
    cancelButtonColor: sweetalert_blue,
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
  //DELETE
  delete_subject = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'warning',
    iconColor: sweetalert_red,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_red,
    showCancelButton: true,
    cancelButtonColor: sweetalert_blue,
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
  //DELETE
  delete_exam_type = () => {
    Swal.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    icon: 'warning',
    iconColor: sweetalert_red,
    confirmButtonText: 'Yes, delete it!',
    confirmButtonColor: sweetalert_red,
    showCancelButton: true,
    cancelButtonColor: sweetalert_blue,
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