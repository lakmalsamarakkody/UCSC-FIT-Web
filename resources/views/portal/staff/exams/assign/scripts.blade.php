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
</script>