@section('script')
<script type="text/javascript">
    $(function () {
        
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.list') }}",
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
                    data: 'nic', 
                    name: 'nic'
                },
                {
                    data: 'bit_eligible', 
                    name: 'bit_eligible'
                },
                {
                    data: 'fit_cert', 
                    name: 'fit_cert'
                },
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: 3,
                    render: function ( data, type, row ) {
                        var color = 'dark';
                        var tag = 'times';
                        if (data == 0) {
                            color = 'dark';
                            tag = 'times';
                        } 
                        if (data == 1) {
                            color = 'success';
                            tag = 'check';
                        }
                        return '<i class="fa fa-'+tag+'"></i>';
                    }
                },
                {
                    targets: 4,
                    render: function ( data, type, row ) {
                        var color = 'dark';
                        var tag = 'times';
                        if (data == 0) {
                            color = 'dark';
                            tag = 'times';
                        } 
                        if (data == 1) {
                            color = 'success';
                            tag = 'check';
                        }
                        return '<i class="fa fa-'+tag+'"></i>';
                    }
                }
            ]   
        });

        view_student = () => {
            // alert('asda');
            window.open("{{ route('student.profile') }}", '_blank')
        }
        
        $(".collapse.show").each(function(){
        // Add chevron-down icon for collapse element which is open by default
            $(this).prev(".card-header").find(".btn").addClass("btn-show");
            $(this).prev(".card-header").addClass("header-show");
            $(this).prev(".card-header").find(".fa").addClass("fa-chevron-down").removeClass("fa-chevron-right");
        });
        
        // Toggle chevron icon and colors on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".card-header").find(".btn").addClass("btn-show");
            $(this).prev(".card-header").addClass("header-show");
            $(this).prev(".card-header").find(".fa").removeClass("fa-chevron-right").addClass("fa-chevron-down");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".card-header").removeClass("header-show");
            $(this).prev(".card-header").find(".btn").removeClass("btn-show");
            $(this).prev(".card-header").find(".fa").removeClass("fa-chevron-down").addClass("fa-chevron-right");
        });

    });
</script>
@endsection