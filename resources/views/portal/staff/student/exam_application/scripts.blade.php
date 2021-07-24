<script type="text/javascript">

    $(document).ready(function(){



        $('.selectAllEtestThree').on('change', function () {
            $('.etestThree').not(this).prop('checked', this.checked);
            count_selected ()
        })

        $('.selectAllEtestTwo').on('change', function () {
            $('.etestTwo').not(this).prop('checked', this.checked);
            count_selected ()
        })

        $('.selectAllEtestOne').on('change', function () {
            $('.etestOne').not(this).prop('checked', this.checked);
            count_selected ()
        })

        $('.selectAllPracTwo').on('change', function () {
            $('.pracTwo').not(this).prop('checked', this.checked);
            count_selected ()
        })

        $('.selectAllPracOne').on('change', function () {
            $('.pracOne').not(this).prop('checked', this.checked);
            count_selected ()
        })
    })

    $('#schedule').on('change', function() {
        let url = null
        if($('#schedule').val()==''){
            url = "{{ route('student.application.exams') }}"
        } else {            
            url = "{{ url('/portal/staff/student/exams/select/schedule/:id') }}"
            url = url.replace(':id', $('#schedule').val())
        }
        window.location.replace(url)
    })

    $('.assign').on('change', function()  {
        count_selected ();
    })

    count_selected = () => {
        var x = $(".assign:checked").length;
        var y =   @if($selSechedule){{ $selSechedule->lab_capacity - $lab_occupied }} @else 0 @endif;
        // alert(y)
        if(x>0){
            $('.assign-applicant').attr('disabled', 'disabled');
        }else{
            $('.assign-applicant').removeAttr('disabled', 'disabled');
        }
        if(x>y){
            SwalSystemErrorDanger.fire({
                title: 'Session capacity limit reached!',
                text: 'Please reduce the selection and assign again',
            })
            $('#selectedCount').html(x);
            $('#btnAssignSelected').attr('disabled', 'disabled');
        }else{
            $('#selectedCount').html(x);
            $('#btnAssignSelected').removeAttr('disabled', 'disabled');
        }
    }

    // ASSIGN ALL SELECTED APPLICANTS
    assign_selected = () => {
        const exmAssignCheck = [];

        // FORM PAYLOAD
        var formData = new FormData($("#applyToExamForm")[0]);
        formData.append('examScheduleId', {{ $selSechedule->id ?? '' }});
        var x = $(".assign:checked").length;
        formData.append('selectedCount', x);

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.assign.selected') }}",
            type: 'post',
            data: formData, 
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#btnAssignSelected').attr('disabled', 'disabled');
                $('#assingSelectedSpinner').removeClass('d-none');
            },
            success: function(data) {
                console.log('Success in assign selected ajax.');
                $('#btnAssignSelected').removeAttr('disabled', 'disabled');
                $('#assingSelectedSpinner').addClass('d-none');
                if(data['status'] == 'unselected'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'No Applicant(s) Selected!',
                        text: 'Select one or more Applicant(s)',
                    })
                }else if(data['status'] == 'full'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Lab Full!',
                        text: 'Lab Capacity is Full',
                    })
                }else if(data['status'] == 'over-limit'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Selected over the Lab Capacity!',
                        text: 'Please reduce the selection and assign again',
                    })
                }else if(data['status'] == 'published'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Session Published!',
                        text: 'Session already published and cannot be changed',
                    })
                }else if(data['status'] == 'success'){
                    location.reload();
                }else{
                    console.log('Error in assign selected controller.');
                    SwalSystemErrorDanger.fire();
                }

            },
            error: function(err) {
                console.log('Error in assign selected ajax.');
                $('#btnAssignSelected').removeAttr('disabled', 'disabled');
                $('#assingSelectedSpinner').addClass('d-none');
                SwalSystemErrorDanger.fire();
            }
        });


    }
    // /ASSIGN ALL SELECTED APPLICANTS

    // ASSIGN ONE APPLICANT
    assign_applicant = (applicant_id, schedule_id) => {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.assign.student') }}",
            type: 'post',
            data: {
                'applicant': applicant_id,
                'schedule' : schedule_id
            }, 
            beforeSend: function() {
                $('.assign-applicant').attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log('Success in assign student ajax.');
                $('.assign-applicant').removeAttr('disabled', 'disabled');
                if(data['status'] == 'full'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Lab Full!',
                        text: 'Lab Capacity is Full',
                    })
                }else if(data['status'] == 'published'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Session Published!',
                        text: 'Session already published and cannot be changed',
                    })
                }else if(data['status'] == 'success'){
                    location.reload();
                }else{
                    console.log('Error in assign student controller.');
                    SwalSystemErrorDanger.fire();
                }

            },
            error: function(err) {
                console.log('Error in assign student ajax.');
                $('.assign-applicant').removeAttr('disabled', 'disabled');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /ASSIGN ONE APPLICANT

    // REMOVE APPLICANT
    remove_applicant = (applicant_id, schedule_id) => {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
            url: "{{ route('student.application.exams.remove.student') }}",
            type: 'post',
            data: {
                'applicant': applicant_id,
                'schedule' : schedule_id
            }, 
            beforeSend: function() {
                $('.remove-applicant').attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log('Success in remove student ajax.');
                $('.remove-applicant').removeAttr('disabled', 'disabled');
                if(data['status'] == 'published'){
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Session Published!',
                        text: 'Session already published and cannot be changed',
                    })
                }else if(data['status'] == 'success'){
                    location.reload();
                }else{
                    console.log('Error in remove student controller.');
                    SwalSystemErrorDanger.fire();
                }
            },
            error: function(err) {
                console.log('Error in remove student ajax.');
                $('.remove-applicant').removeAttr('disabled', 'disabled');
                SwalSystemErrorDanger.fire();
            }
        });
    }
    // /REMOVE APPLICANT

    // PUBLISH SCHEDULE
    publish_schedule = (schedule_id) => {
        
        SwalQuestionDangerAutoClose.fire({
            title: "Are you sure?",
            text: "You wont be able to revert this!",
            confirmButtonText: 'Yes, Publish Schedule Now!',
        })
        .then((result) => {
            if(result.isConfirmed) {
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('student.application.exams.publish.schedule') }}",
                type: 'post',
                data: {
                    'scheduleId' : schedule_id
                },           
                beforeSend: function(){
                    $('.btn').attr('disabled','disabled');
                },
                success: function(data){
                    $('.btn').removeAttr('disabled');
                    if (data['status'] == 'success'){
                        SwalDoneSuccess.fire({
                            title: 'Session Published!',
                            text: 'All students are notified with session details',
                        }).then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else if(data['status'] == 'empty'){
                        SwalNotificationWarningAutoClose.fire({
                            title: 'Session Empty!',
                            text: 'Assign students and publish again',
                        })
                    }else{
                        SwalSystemErrorDanger.fire()
                    }
                },
                error: function(err){
                    $('.btn').removeAttr('disabled');
                    SwalSystemErrorDanger.fire()
                }
            })
            }
            else{
            SwalNotificationWarningAutoClose.fire({
                title: 'Aborted!',
                text: 'Student Registration process aborted.',
            })
            }
        })
    }
    // /PUBLISH SCHEDULE

</script>