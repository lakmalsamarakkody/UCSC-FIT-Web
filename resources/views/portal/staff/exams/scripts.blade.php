<script type="text/javascript">

  // CREATE
  create_shedule = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "Shedule will add to the shedule table",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: 'Created!',
          text: 'Exam shedule created.',
        })
        $('#modal-create-role').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam shedule has not been created.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  edit_shedule = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Shedule will be update.",
      confirmButtonText: "Yes, Update!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSuccess.fire({
          title: "Updated!",
          text: "Exam shedule updated.",
        })
        $('#editShedule').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Exam shedule has not been updated.",
        })
      }
    })
  }

  // /EDIT

  // POSTPONE

  postpone_exam = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Shedule will be postpone.",
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


</script>