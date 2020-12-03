<script type="text/javascript">
    $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('student.list') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'reg_no', name: 'Registration NO'},
            {data: 'full_name', name: 'Full Name'},
            {data: 'nic', name: 'NIC'},
            {data: 'bit_eligible', name: 'BIT Eligibility'},
            {data: 'fit_cert', name: 'FIT Certificate'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
            },
        ]
    });
    
    });
</script>