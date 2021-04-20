<script type="text/javascript">

let assignScheduleTable = null;

$(function(){
    // SCHEDULES TABLE
    assignScheduleTable = $('.assign-exam-schedules-yajradt').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        order:[4, "asc"],
        ajax: {
            url: "{{ route('exams.assign.schedules.table') }}",
            data: function(d) {
                d.year = $('#searchAssignExamYear').val();
                d.exam = $('#searchAssignExam').val();
                d.date = $('#searchAssignExamDate').val();
                d.subject = $('#searchAssignSubject').val();
                d.type = $('#searchAssignExamType').val();
            }
        },
        columns: [
            {
                data: 'month',
                name: 'month'
            },
            {
                data: 'subject_code',
                name: 'subject_code'
            },
            {
                data: 'subject_name',
                name: 'subject_name'
            },
            {
                data: 'exam_type',
                name: 'exam_type'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'start_time',
                name: 'start_time'
            },
            {
                data: 'end_time',
                name: 'end_time'
            },
            {
                data: 'id',
                name: 'id',
                orderable: false,
                searchable: false
            },
        ],
        columnDefs: [
            {
                targets: 0,
                render: function(data, type, row) {
                    var exam = row['year'] + " " + row['month'];
                    return exam;
                }
            },
            {
                targets: 1,
                render : function(data, type, row) {
                    return 'FIT '+data;
                }
            },
            {
                targets: 7,
                render: function(data, type, row) {
                    let assignBtn = '<div class="btn-group">'+
                    '<button type="button" class="btn btn-outline-primary" data-tooltip="tooltip" data-placement="bottom" title="Assign Students" id="btnAssignStudents-'+data+'" onclick="invoke_assign_students_modal('+data+');">Assign</button>'+
                    '</div>';
                    return assignBtn;
                }
            }
        ]
    });

    search_assign_exams = () => {
        assignScheduleTable.draw();
    }
    // / SCHEDULES TABLE
});

// STUDENT LIST MODAL
// STUDENT TABLE
let studentTable =  null;
draw_student_table = () => {
    $('.tbl-assign-students-yajradt').DataTable().clear().destroy();
    studentTable = $('.tbl-assign-students-yajradt').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('exams.assign.students.table') }}",
            data: function(d) {
                d.year = $('#year').val();
                d.name = $('#name').val();
                d.search = $('#searchAll').val();
                d.regNo = $('#regNo').val();
                d.nic = $('#nic').val();
            }
        },
        columns: [
            {
                data: 'reg_no', 
                name: 'reg_no'
            },
            {
                data: 'full_name', 
                name: 'full_name'
            },
            {
                data: 'nic_old', 
                name: 'nic_old'
            },
            {
                data: 'student_id', 
                name: 'student_id', 
                orderable: false, 
                searchable: false
            },
        ],
        columnDefs: [
            {
                targets: 3,
                render: function(data, type, row) {
                    var checkBox = '<div class="input-group"><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></div>';
                    return checkBox;
                }
            },
        ]
    });
}

search_students = () => {
    studentTable.draw();
}
// /STUDENT TABLE

invoke_assign_students_modal = (schedule_id) => {

    // Remove previous searches
    $('#searchAll').val('');
    // $('#year').val('');
    $('#name').val('');
    $('#regNo').val('');
    $('#nic').val('');

    // Form Payload
    var formData = new FormData();
    formData.append('schedule_id', schedule_id);

    // Get exam schedule details controller
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('exams.assign.schedule.details') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {$('#btnAssignStudents-'+schedule_id).attr('disabled', 'disabeld');},
        success: function(data) {
            console.log('Success in get exam schedule details ajax.');
           if(data['status'] == 'success') {
               console.log('Success in get exam schedule details.');
               if(data['schedule'] != null) {
                   $('#assignScheduleId').val(data['schedule']['id']);
                   $('#spanAssignSubject').html('FIT ' + data['schedule']['subject_code'] + ' - ' + data['schedule']['subject_name']);
                   $('#spanAssignExamType').html(data['schedule']['exam_type']);
                   $('#spanAssignExamDate').html(data['schedule']['date']);
                   $('#spanAssignExamTime').html(data['schedule']['start_time'] + ' - ' + data['schedule']['end_time']);

                   draw_student_table();
                   $('#btnAssignStudents-'+schedule_id).removeAttr('disabled', 'disabled');
                   $('#modal-assign-student-list').modal('show');
               }
           }
        },
        error: function(err) {
            console.log('Error in get exam schedule details ajax.');
            $('#btnAssignStudents-'+schedule_id).removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
        }
    });
}
// /STUDENT LIST MODAL

// ASSIGN STUDENTS FOR EXAM
assign_students = () => {

    SwalQuestionSuccessAutoClose.fire({
        title: 'Are you sure?',
        text: 'Selected students will assign for the scheduled exam.',
        confirmButtonText: 'Yes, Assign!',
    })
    .then((result) => {
        if(result.isConfirmed) {
            // Get the selected stundets ids
            assignStudents = [];
            $('.assign-exam-check').each(function() {
                if($(this).is(":checked")) {
                    assignStudents.push($(this).val());
                }
            });

            // Form Payload
            let formData = new FormData();
            formData.append('schedule_id', $('#assignScheduleId').val());
            var json_arr = JSON.stringify(assignStudents);
            formData.append('assign_students', json_arr);
           

            // Assign students for exam controller
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="x-csrf-token"]').attr('content')},
                url: "{{ route('exams.assign.students') }}",
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnAssignStudents').attr('disabled', 'disabled');
                    $('#spinnerBtnAssignStudents').removeClass('d-none');
                },
                success: function(data) {
                    console.log('Success in assign students for exam ajax.');
                    $('#btnAssignStudents').removeAttr('disabled', 'disabled');
                    $('#spinnerBtnAssignStudents').addClass('d-none');
                    if(data['status'] == 'unselected') {
                        SwalNotificationWarningAutoClose.fire({
                            title: 'Unselected!',
                            text: 'You did not select any students.',
                        })
                    }
                    else if(data['status'] == 'success') {
                        console.log('Success in assign students for exam.');
                        SwalDoneSuccess.fire({
                            title: 'Success!',
                            text: 'Selected students have assigned for the exam.',
                        })
                        .then((result) => {
                            if(result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(err) {
                    console.log('Error in assign students for exam ajax.');
                    $('#btnAssignStudents').removeAttr('disabled', 'disabled');
                    $('#spinnerBtnAssignStudents').addClass('d-none');
                    SwalSystemErrorDanger.fire();
                }
            });
        }
        else {
            SwalNotificationWarningAutoClose.fire({
                title: 'Cancelled!',
                text: 'Selected students have not been assigned.',
            })
        }
    });
}
// /ASSIGN STUDENTS FOR EXAM
</script>