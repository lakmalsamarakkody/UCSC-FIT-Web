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
    SwalQuestionSuccessAutoCLose.fire({
      title: "Are you sure ?",
      text: "Shedule will be update",
      confirmButtonText: "Yes, Update !",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalDoneSUccess.fire({
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


</script>