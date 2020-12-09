@section('script')
<script type="text/javascript">

$(function () {
    
    // var table = $('.yajra-datatable').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('student.list') }}",
    //     columns: [
    //         {
    //             data: 'reg_no', 
    //             name: 'reg_no'
    //         },
    //         {
    //             data: 'full_name', 
    //             name: 'full_name'
    //         },
    //         {
    //             data: 'nic', 
    //             name: 'nic'
    //         },
    //         {
    //             data: 'bit_eligible', 
    //             name: 'bit_eligible'
    //         },
    //         {
    //             data: 'fit_cert', 
    //             name: 'fit_cert'
    //         },
    //         {
    //             data: 'action', 
    //             name: 'action', 
    //             orderable: false, 
    //             searchable: false
    //         },
    //     ],
    //     columnDefs: [
    //         {
    //             targets: 3,
    //             render: function ( data, type, row ) {
    //                 var color = 'dark';
    //                 var tag = 'times';
    //                 if (data == 0) {
    //                     color = 'dark';
    //                     tag = 'times';
    //                 } 
    //                 if (data == 1) {
    //                     color = 'success';
    //                     tag = 'check';
    //                 }
    //                 return '<i class="fa fa-'+tag+'"></i>';
    //             }
    //         },
    //         {
    //             targets: 4,
    //             render: function ( data, type, row ) {
    //                 var color = 'dark';
    //                 var tag = 'times';
    //                 if (data == 0) {
    //                     color = 'dark';
    //                     tag = 'times';
    //                 } 
    //                 if (data == 1) {
    //                     color = 'success';
    //                     tag = 'check';
    //                 }
    //                 return '<i class="fa fa-'+tag+'"></i>';
    //             }
    //         }
    //     ]   
    // });

});
</script>
@endsection