<script type="text/javascript">
// CREATE EXAM SCHEDULE
  // CREATE
  create_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Exam schedule will be create.",
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
      text: "Exam schedule will be update.",
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

  // DELETE(BEFORE RELEASE)
  delete_before_release = () => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Deleted!',
          text: 'Scheduled exam has been deleted.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Scheduled exam has not been deleted.',
        })
      }
    })
  }
  // /DELETE(BEFORE RELEASE)

  // APPROVE SCHEDULE
  approve_schedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Scheduled exam will be approve.",
      confirmButtonText: "Yes, Approve!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Approved!',
          text: 'Scheduled exam has been approved.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Scheduled exam has not been approved.',
        })
      }
    })
  }
  // /APPROVE SCHEDULE

  // REQUEST SCHEDULE APPROVAL
  request_schedule_approval = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Request will be send to Coordinator.",
      confirmButtonText: "Yes, Send Request!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Approval requested!',
          text: 'Request has been sent to Coordinator.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Request has not been sent.',
        })
      }
    })
  }
  // /REQUEST SCHEDULE APPROVAL

  // RELEASE INDIVIDUAL EXAM SCHEDULE
  relase_individual_schedule = () => {
    SwalQuestionSuccessAutoClose.fire ({
      title: "Are you sure ?",
      text: "Exam schedule will be release",
      confirmButtonText: "Yes, Release!",
    })
    .then((result) => {
      if(result.isConfirmed){
        SwalDoneSuccess.fire({
          title: 'Released!',
          text: 'Exam schedule has been released.',
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam schedule has not been released.',
        })
      }
    })
  }
  // /RELEASE INDIVIDUAL EXAM SCHEDULE

// /CREATE EXAM SCHEDULE


// EXAM SCHEDULES

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
          title: "Postponed!",
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

// /EXAM SCHEDULES

</script>