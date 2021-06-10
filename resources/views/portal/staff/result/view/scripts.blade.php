@section('script')
<script type="text/javascript">
  $(function () {
    var table = $('.yajra-datatable').DataTable({
    });
  });

  view_student = (id) => {
    var url = '{{ route("student.profile", ":id") }}';
    url = url.replace(':id', id);
    window.open( url,'Student_Profile')
  }

  pushResults = (exam_id) => {
    let pushUpMark = 48;
    let subjectID = $('#subject').val();
    let subjectName = $('#subject option:selected').text();
    let examTypeID = $('#examType').val();
    let examTypeName = $('#examType option:selected').text();
    if($('#txtPushMark').val() && $('#txtPushMark').val()<50 ){
      pushUpMark = $('#txtPushMark').val();
    }
    if(subjectID=="null" || examTypeID=="null"){
      SwalNotificationWarningAutoClose.fire({
        title: "Please select!",
        text: "select the subject and exam type to proceed",
      });
      return;
    }
    SwalQuestionDanger.fire({
      title: "Are you sure? Results will be pushed up!",
      html: "Subject : <b>"+subjectName+"</b><br>ExamType : <b>"+examTypeName+"</b><br>Pushup mark : <b>"+pushUpMark+"</b>",
      confirmButtonText: "Yes, push results!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('results.pushUpResults') }}",
          type: 'post',
          data :{
            'examId':exam_id,
            'subjectID':subjectID,
            'examTypeID':examTypeID,
            'pushUpMark':pushUpMark
          },
          beforeSend: function()
          {
            $("#btnPushResultsSpinner").removeClass('d-none');
            $('#btnPushResults').attr('disabled', 'disabled');
          },
          success: function(data)
          {
            $("#btnPushResultsSpinner").addClass('d-none');
            $('#btnPushResults').removeAttr('disabled', 'disabled');

            if(data['status'] == "success"){  
              SwalDoneSuccess.fire({
                title: "Process Completed!",
                text: "Marks have been pushed up Successfully",
              }).then((result) => {
                if (result.isConfirmed) { location.reload(); }});
            }else if (data['status'] == "error"){
              SwalNotificationWarning.fire({
                title: 'Process Failed!',
                text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
              })
            }
          },
          error: function(err)
          {
            $("#btnPushResultsSpinner").addClass('d-none');
            $('#btnPushResults').removeAttr('disabled', 'disabled');
            
            SwalNotificationWarning.fire({
                title: 'Process Failed!',
                text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
            })
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Result Pushing process aborted",
        })
      }
    });
  }
</script>
@endsection