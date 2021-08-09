@section('script')
<script type="text/javascript">
    $(function () {
        $('#ver').on('change', function(){
            var ver = $(this).val()
            $('.version').html(ver)
        })

        download_latest_version = () => {
            var url = '{{ route("download.students", ":download_version") }}';
            var id = $('#ver').val()
            url = url.replace(':download_version', id);
            location.replace( url,'Student_Profile')
        }
        
        var table = $('.yajra-datatable').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('student.list') }}",
                data : function (d) {
                    d.year = $('#year').val();
                    d.name = $('#name').val();
                    d.search = $('#searchAll').val();
                    d.regNo = $('#regNo').val();
                    d.nic = $('#nic').val();
                    d.bit = $('#bit').val();
                    d.fit = $('#fit').val();
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
                    data: 'bit_eligible', 
                    name: 'bit_eligible'
                },
                {
                    data: 'fit_cert', 
                    name: 'fit_cert'
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
                    targets: 2,
                    render: function(data, type, row) {
                        var nic = null;
                        if(row['nic_old'] != null) {
                            nic = row['nic_old'];
                        }
                        if(row['nic_new'] != null) {
                            nic = row['nic_new'];
                        }
                        if(row['postal'] != null) {
                            nic = row['postal'];
                        }
                        if(row['passport'] != null) {
                            nic = row['passport'];
                        }
                        return nic;
                    }
                },
                {
                    targets: [3,4],
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
                },
                {
                    targets: 5,
                    render: function ( data, type, row ) {
                        var button = '@if(Auth::user()->hasPermission("staff-student-profile"))<a onclick="view_student('+data+');" title="View Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>@endif';
                        return button;
                    }
                }
            ]   
        });

        search = () => {
            table.draw();

        }

        $(".view-student").on('click',function() {
            // alert ('sdfsd');
            var id = $(this).closest("tr").find('.id').text();   
                       alert (id);
        });

        view_student = (id) => {
            var url = '{{ route("student.profile", ":id") }}';
            url = url.replace(':id', id);
                    //    alert (id)
//                     let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
// width=1500,height=700,left=100,top=100`;
            window.open( url,'Student_Profile')
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