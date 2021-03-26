@section('script')
<script type="text/javascript">

    CKEDITOR.replace('description', {
        // filebrowserBrowseUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",    
        filebrowserImageUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });   



    $(function () {

        var announcementTable = $('.yajra-datatable').DataTable({
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
                    data: 'created_at', 
                    name: 'created_at'
                },
                {
                    data: 'updated_at', 
                    name: 'updated_at'
                },
                {
                    data: 'id', 
                    name: 'id',
                    className: "text-right", 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: 3,
                    render: function ( data, type, row ) {
                        var button_group =  '<div class="btn-group" role="group" aria-label="Basic example">';
                        var button_view = @if(Auth::user()->hasPermission('staff-website-announcement-add'))'<button title="View Announcement" data-tooltip="tooltip"  data-placement="bottom" onclick="view_announcement('+data+');" type="button" class="btn btn-outline-info"><i class="fas fa-eye"></i></button>' @else "" @endif;
                        var button_edit = @if(Auth::user()->hasPermission('staff-website-announcement-edit'))'<button title="Edit Announcement" data-tooltip="tooltip"  data-placement="bottom" onclick="edit_announcement_get_details('+data+');" type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i></button>' @else "" @endif;
                        var button_publish = @if(Auth::user()->hasPermission('staff-website-announcement-publish'))'<button title="Publish Announcement" data-tooltip="tooltip"  data-placement="bottom" onclick="publish_announcement('+data+');" type="button" class="btn btn-outline-success"><i class="fas fa-bullhorn"></i></button>' @else "" @endif;
                        var button_unpublish = @if(Auth::user()->hasPermission('staff-website-announcement-unpublish'))'<button title="Unpublish Announcement" data-tooltip="tooltip"  data-placement="bottom" onclick="unpublish_announcement('+data+');" type="button" class="btn btn-outline-secondary"><i class="fas fa-bullhorn"></i> <i class="fas fa-ban"></i></button>' @else "" @endif;
                        var button_mail = @if(Auth::user()->hasPermission('staff-website-announcement-mail'))'<button title="Email Announcement" data-tooltip="tooltip"  data-placement="bottom" onclick="mail_announcement('+data+');" type="button" class="btn btn-outline-primary"><i class="fas fa-envelope"></i></button>' @else "" @endif;
                        var button_delete = @if(Auth::user()->hasPermission('staff-website-announcement-delete'))'<button title="Delete Announcement" data-tooltip="tooltip"  data-placement="bottom" onclick="delete_announcement('+data+');" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>' @else "" @endif;
                        button_group = button_group + button_view;
                        if(row['published'] != 1){button_group = button_group + button_edit + button_publish + button_delete}
                        if(row['published'] == 1){button_group = button_group + button_unpublish + button_mail}
                        button_group = button_group + '</div>';
                        return button_group;
                    }
                }
            ]   
        });

        search = () => {
            announcementTable.draw();

        }

        $(".view-student").on('click',function() {
            // alert ('sdfsd');
            var id = $(this).closest("tr").find('.id').text();   
            alert (id);
        });
        
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

        refresh_modal =() => {
            $('#id').val('')
            $('#title').val('')
            CKEDITOR.instances['description'].setData('')            
            $('#btnCreateAnnouncement').html('Create')
        }

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
                    var formData = new FormData($("#formCreateAnnouncement")[0]);
                    var description = CKEDITOR.instances.description.getData();
                    // var formData = new FormData();
                    // //Add data
                    formData.append('description', description);
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
                            console.log('success in create announcement ajax');
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
                            console.log('create announcement is success');
                            SwalDoneSuccess.fire({
                                title: 'Created!',
                                text: 'Announcement created.',
                                })
                                .then((result) => {
                                $('#modal-create-announcement').modal('hide');
                                announcementTable.draw();
                                //location.reload();
                                })
                            }                            
                            else if(data['updated'] == 'success'){
                            console.log('update announcement is success');
                            SwalDoneSuccess.fire({
                                title: 'Updated!',
                                text: 'Announcement updated.',
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
                        text: 'Announcement creation cancelled.',
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

        edit_announcement_get_details = (id) => {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('staff.website.announcements.edit.get.details') }}",
                type: 'post',
                data:{'id':id},
                beforeSend: function(){
                    $('.btn').attr('disabled','disabled');
                },
                success: function(data){
                    console.log('success in get details to edit announcement ajax');
                    $('.btn').removeAttr('disabled','disabled');
                    $('#id').val(data['id'])
                    $('#title').val(data['title'])
                    $('#btnCreateAnnouncement').html('Update')
                    // $('#description').val(data['description'])
                    CKEDITOR.instances['description'].setData(data['description'])
                    $('#modal-create-announcement').modal('show');
                        
                },
                error: function(err){
                    $('#btnCreateAnnouncement').removeAttr('disabled','disabled');
                    console.log('error in get details to edit announcement ajax');
                    SwalSystemErrorDanger.fire();
                }
            });
        }

        publish_announcement = (id) => {
            SwalQuestionSuccessAutoClose.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this!",
                confirmButtonText: 'Yes, Publish!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('staff.website.announcements.publish') }}",
                        type: 'post',
                        data:{'id':id},
                        beforeSend: function(){
                            $('.btn').attr('disabled','disabled');
                        },
                        success: function(data){
                            $('.btn').removeAttr('disabled','disabled');
                            if(data['status'] == 'success'){
                                console.log('email publish ajax is success');
                                SwalDoneSuccess.fire({
                                    title: 'Published!',
                                    text: 'Announcement published successfully.',
                                })
                                .then((result) => {
                                    announcementTable.draw();
                                    //location.reload();
                                })
                            }else{
                                console.log('error on publishing email ajax');
                                SwalSystemErrorDanger.fire();
                            }
                        },
                        error: function(err){
                            $('.btn').removeAttr('disabled','disabled');
                            console.log('error in publish announcement ajax');
                            SwalSystemErrorDanger.fire();
                        }
                    });
                }else{
                    
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Cancelled!',
                        text: 'Announcement publish process cancelled.',
                    })
                }
            })
        }

        unpublish_announcement = (id) => {
            SwalQuestionDangerAutoClose.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this!",
                confirmButtonText: 'Yes, Unpublish!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('staff.website.announcements.unpublish') }}",
                        type: 'post',
                        data:{'id':id},
                        beforeSend: function(){
                            $('.btn').attr('disabled','disabled');
                        },
                        success: function(data){
                            $('.btn').removeAttr('disabled','disabled');
                            if(data['status'] == 'success'){
                                console.log('email unpublish ajax is success');
                                SwalDoneSuccess.fire({
                                    title: 'Unpublished!',
                                    text: 'Announcement unpublished successfully.',
                                })
                                .then((result) => {
                                    announcementTable.draw();
                                    //location.reload();
                                })
                            }else{
                                console.log('error on unpublishing email ajax');
                                SwalSystemErrorDanger.fire();
                            }
                        },
                        error: function(err){
                            $('.btn').removeAttr('disabled','disabled');
                            console.log('error in unpublish announcement ajax');
                            SwalSystemErrorDanger.fire();
                        }
                    });
                }else{
                    
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Cancelled!',
                        text: 'Announcement unpublish process cancelled.',
                    })
                }
            })
        }

        mail_announcement = (id) => {
            
            SwalQuestionSuccessAutoClose.fire({
                title: "Are you sure?",
                text: "You wont be able to revert this!",
                confirmButtonText: 'Yes, Mail All!',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('staff.website.announcements.email') }}",
                        type: 'post',
                        data:{'id':id},
                        beforeSend: function(){
                            $('.btn').attr('disabled','disabled');
                        },
                        success: function(data){
                            $('.btn').removeAttr('disabled','disabled');
                            if(data['status'] == 'success'){
                                console.log('email announcement is success');
                                SwalDoneSuccess.fire({
                                    title: 'Created!',
                                    text: 'Announcement emailed.',
                                })
                                .then((result) => {
                                    location.reload();
                                })
                            }else{
                                console.log('error on emailing announcement');
                            }
                        },
                        error: function(err){
                            $('.btn').removeAttr('disabled','disabled');
                            console.log('error in email announcement ajax');
                            SwalSystemErrorDanger.fire();
                        }
                    });
                }else{
                    
                    SwalNotificationWarningAutoClose.fire({
                        title: 'Cancelled!',
                        text: 'Announcement emailing cancelled.',
                    })
                }
            })
        }
    });
</script>
@endsection