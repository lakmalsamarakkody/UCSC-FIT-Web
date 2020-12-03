<script type="text/javascript">
// EDIT
release_shedule = () => {
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
</script>