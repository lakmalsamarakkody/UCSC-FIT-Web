<script type="text/javascript">
    $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('student.list') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: 'reg_no', 
                name: 'Registration NO',
                orderable: true, 
                searchable: true
            },
            {
                data: 'full_name', 
                name: 'Full Name',
                orderable: true, 
                searchable: true
            },
            {
                data: 'nic', 
                name: 'NIC',
                orderable: true, 
                searchable: true
            },
            {
                data: 'bit_eligible', 
                name: 'BIT Eligibility',
                orderable: true, 
                searchable: true
            },
            {
                data: 'fit_cert', 
                name: 'FIT Certificate',
                orderable: true, 
                searchable: true
            },
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