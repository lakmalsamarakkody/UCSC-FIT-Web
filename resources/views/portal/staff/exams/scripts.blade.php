<script type="text/javascript">
// CREATE EXAM SCHEDULE
  // CREATE
  create_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Schedule will be create.",
      confirmButtonText: "Yes, Create!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Created!",
          text: "Exam schedule created.",
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam schedule has not been created.",
        })
      }
    })
  }
  // /CREATE

  // EDIT
  edit_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Schedule will be update.",
      confirmButtonText: "Yes, Update!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Updated!",
          text: "Exam schedule updated.",
        })
        $('#editSchedule').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam schedule has not been updated.",
        })
      }
    })
  }
  // /EDIT


  // POSTPONE
  postpone_exam = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam will be postpone.",
      confirmButtonText: "Yes, Postpone!",
    })
    .then((result) => {
      if(result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Postponded",
          text: "Exam postponed.",
        })
        $('#postponeExam').modal('hide')
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam has not been postponed.",
        })
      }
    })
  }
  // /POSTPONE

  // DELETE(BEFORE RELEASE)
  delete_before_release = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Exam has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam has not been deleted.',
        })
      }
    })
  }
  // /DELETE(BEFORE RELEASE)
// /CREATE EXAM SCHEDULE

// EXAM SCHEDULES
  

// /EXAM SCHEDULES

</script>