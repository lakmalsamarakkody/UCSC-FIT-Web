@section('script')
<script type="text/javascript">
    $(function () {
        
        var table = $('.yajra-datatable').DataTable({
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('staff.website.announcements') }}",
            },
            columns: [
                {
                    data: 'title', 
                    name: 'title'
                },
                {
                    data: 'description', 
                    name: 'description'
                },
                {
                    data: 'image', 
                    name: 'image'
                },
                {
                    data: 'created_at', 
                    name: 'created_at'
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
                    targets: 2,
                    render: function ( data, type, row ) {
                        if (data != null) {
                            return data;
                        } 
                        else{
                            return 'No Image';
                        };
                    }
                },
                {
                    targets: 4,
                    render: function ( data, type, row ) {
                        var button_group =  "<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">"+
                                            "<button title=\"View Announcement\" data-tooltip=\"tooltip\"  data-placement=\"bottom\" onclick=\"view_announcement("+data+");\" type=\"button\" class=\"btn btn-outline-success\"><i class=\"fas fa-eye\"></i></button>"+
                                            "<button title=\"Edit Announcement\" data-tooltip=\"tooltip\"  data-placement=\"bottom\" onclick=\"edit_announcement("+data+");\" type=\"button\" class=\"btn btn-outline-warning\"><i class=\"fas fa-edit\"></i></button>"+
                                            "<button title=\"Publish Announcement\" data-tooltip=\"tooltip\"  data-placement=\"bottom\" onclick=\"publish_announcement("+data+");\" type=\"button\" class=\"btn btn-outline-primary\"><i class=\"fas fa-envelope\"></i></button>"+
                                            "</div>"
                        return button_group;
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

        view_announcement = (id) => {
            var url = '{{ route("web.announcement", ":id") }}';
            url = url.replace(':id', id);
                    //    alert (id)
                    let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
width=1200,height=1000,left=100,top=100`;
            window.open( url,'Student_Profile',params)
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

        create_announcement = () => {
            SwalQuestionSuccessAutoClose.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this!",
                confirmButtonText: 'Yes, Create!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    //Remove previous validation error messages
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').html('');
                    $('.invalid-feedback').hide();
                    //Form Payload
                    var formData = new FormData($("#formUserRole")[0]);
                    // var formData = new FormData();
                    // //Add data
                    // formData.append('inputNewRoleName', $('#inputNewRoleName').val())
                    // formData.append('inputNewRoleDescription', $('#inputNewRoleDescription').val())

                    //Validate information
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('staff.website.announcements.create') }}",
                        type: 'post',
                        data:formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function(){
                            $('#btnCreateAnnouncement').attr('disabled','disabled');
                        },
                        success: function(data){
                            console.log('success in create role ajax');
                            $('#btnCreateAnnouncement').removeAttr('disabled','disabled');
                            if(data['errors']){
                            console.log('errors on validating data');
                            $.each(data['errors'], function(key, value){
                                $('#error-'+key).show();
                                $('#'+key).addClass('is-invalid');
                                $('#error-'+key).append('<strong>'+value+'</strong>');
                            });
                            }
                            else if(data['success'] == 'success'){
                            console.log('create role is success');
                            SwalDoneSuccess.fire({
                                title: 'Created!',
                                text: 'Announcement created.',
                                })
                                .then((result) => {
                                location.reload();
                                })
                            }
                        },
                        error: function(err){
                            $('#btnCreateAnnouncement').removeAttr('disabled','disabled');
                            console.log('error in create announcement ajax');
                            SwalSystemErrorDanger.fire();
                        }
                    });
                }
                else{
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Cancelled!',
                        text: 'User role creation cancelled.',
                    })
                }
            })

        }

        view_announcement = (id) => {
            var url = "{{ route('web.announcement', ':id') }}"
            url = url.replace(':id', id);
            let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1200,height=1000,left=100,top=100`;
            window.open(url, 'Announcement', params)
        }

    });
</script>
@endsection