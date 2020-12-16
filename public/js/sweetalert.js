// SWEETALERT
// SWEETALERT QUESTION 
const SwalQuestionSuccess = Swal.mixin({
  icon: 'question',
  iconColor: color_success,
  confirmButtonColor: color_success,
  showCancelButton: true,
  cancelButtonColor: color_primary,
  allowOutsideClick: false,
})
const SwalQuestionSuccessAutoClose = Swal.mixin({
  icon: 'question',
  iconColor: color_success,
  confirmButtonColor: color_success,
  showCancelButton: true,
  cancelButtonColor: color_primary,
  timer: 5000,
  timerProgressBar: true,
  allowOutsideClick: false,
})
const SwalQuestionDanger = Swal.mixin({
  icon: 'question',
  iconColor: color_danger,
  confirmButtonColor: color_danger,
  showCancelButton: true,
  cancelButtonColor: color_primary,
  timer: 5000,
  timerProgressBar: true,
  allowOutsideClick: false,
})
const SwalQuestionWarningAutoClose = Swal.mixin({
  icon: 'question',
  iconColor: color_warning,
  confirmButtonColor: color_warning,
  showCancelButton: true,
  cancelButtonColor: color_primary,
  timer: 5000,
  timerProgressBar: true,
  allowOutsideClick: false,
})
// SWEETALERT QUESTION

// SWEETALERT DONE 
const SwalDoneSuccess = Swal.mixin({
  icon: 'success',
  confirmButtonColor: color_success,
  allowOutsideClick: false,
})

// SWEETALERT CANCEL 
const SwalCancelWarning = Swal.mixin({
  icon: 'warning',
  iconColor: color_warning,
  confirmButtonColor: color_warning,
})

// SWEETALERT ERROR 
const SwalSystemErrorDanger = Swal.mixin({
  icon: 'error',
  iconColor: color_danger,
  title: 'System Error!',
  text: 'Please contact your System Administrator',
  confirmButtonColor: color_danger,
  allowOutsideClick: false,
})
// /SWEETALERT ERROR 

// SWEETALERT NOTIFICATION 
const SwalNotificationSuccess = Swal.mixin({
  icon: 'success',
  iconColor: color_success,
  showConfirmButton: false,
  toast: true,
  position: 'top-end',
  timer: 5000,
  timerProgressBar: true,
})
const SwalNotificationWarning = Swal.mixin({
  icon: 'warning',
  iconColor: color_warning,
  showConfirmButton: false,
  toast: true,
  position: 'top-end',
})
const SwalNotificationWarningAutoClose = Swal.mixin({
  icon: 'warning',
  iconColor: color_warning,
  showConfirmButton: false,
  toast: true,
  position: 'top-end',
  timer: 5000,
  timerProgressBar: true,
})
// /SWEETALERT NOTIFICATION