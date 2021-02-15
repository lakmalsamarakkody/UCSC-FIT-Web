<script type="text/javascript">

let permissionTable = null;

  // PERMISSION
  $(function(){
    // PERMISSIONS TABLE
    permissionTable = $('.permissions-yajradt').DataTable({
      processing: true,
      searching: true,
      serverSide: true,
      ajax: {
        url: "{{ route('permissions.table') }}",
      },
      columns: [
        {
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'portal',
          name: 'portal'
        },
        {
          data: 'module',
          name: 'module'
        },
        {
          data: 'description',
          name: 'description'
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
          targets: 5,
          render: function(data, type, row) {
            var btnGroup = '<div class="btn-group">';
              btnGroup = btnGroup + '@if(Auth::user()->hasPermission("staff-system-permission-edit"))<button type="button" class="btn btn-outline-warning" id="btnEditPermission-'+data+'" onclick="edit_permission_modal_invoke('+data+');"><i class="fas fa-edit"></i></button>@endif';
              btnGroup = btnGroup + '@if(Auth::user()->hasPermission("staff-system-permission-delete"))<button type="button" class="btn btn-outline-danger" id="btnDeletePermission-'+data+'" onclick="delete_permission('+data+');"><i class="fas fa-trash-alt"></i></button>@endif';
              btnGroup = btnGroup + '</div>';
              return btnGroup;
          }
        }
      ]
    });
    // /PERMISSIONS TABLE
  });

  // CREATE
  create_permission = () => {
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

        //Form Data
        var formData = new FormData($('#formCreatePermission')[0]);
        //Validate information
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/createPermission') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreatePermission').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in create permission ajax.');
            $('#btnCreatePermission').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('Errors on validation data.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Create permission success.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Permission created.',
              })
              $('#modal-create-permission').modal('hide');
              permissionTable.draw();
            }
          },
          error: function(err){
            $('#btnCreatePermission').removeAttr('disabled','disabled');
            console.log('Error in create permission ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Permission has not been created.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_permission_modal_invoke = (permission_id) =>{
    //Payload
    var formData = new FormData();
    formData.append('permission_id',permission_id);

    //Edit permission get detials
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editPermissionGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditPermission-'+permission_id).attr('disabled','disabled');},
      success: function(data){
        console.log('Success in edit permission get detials ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-permission-title').html(data['permission']['name']);
          $('#permissionID').val(data['permission']['id']);
          $('#permissionName').val(data['permission']['name']);
          $('#portalName').val(data['permission']['portal']);
          $('#permissionModule').val(data['permission']['module']);
          $('#permissionDescription').val(data['permission']['description']);
          $('#modal-edit-permission').modal('show');
          $('#btnEditPermission-'+permission_id).removeAttr('disabled','disabled');
        }
      },
      error: function(err){
        console.log('Error in edit permission get details ajax.');
        $('#btnEditPermission-'+permission_id).removeAttr('disabled','disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_permission = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form payload
        var formData = new FormData($('#formEditPermission')[0]);

        //Edit permission
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editPermission') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditPermission').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit permission ajax.');
            $('#btnModalEditPermission').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating data.');
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Edit permission is success.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Permission has been updated.',
              })
              $('#modal-edit-permission').modal('hide')
              permissionTable.draw();
            }
          },
          error: function(err){
            console.log('Error in edit permission ajax.');
            $('#btnModalEditPermission').removeAttr('disabled','disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Permission has not been updated.',
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_permission = (permission_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Payload
        var formData = new FormData();
        formData.append('permission_id',permission_id);

        //Delete permission controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/deletePermission') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeletePermission-'+permission_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success in delete permission ajax.');
            //remove delete data included row
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Permission has been deleted.',
            })
            permissionTable.draw();
          },
          error: function(err){
            console.log('Error in delete permission ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Permission has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /PERMISSION

// USER ROLE
  // ROLE NAME EDITABILITY
  InputRoleName_editable = () => {
    if($('#roleNameEdit').attr('disabled')){
      $('#roleNameEdit').removeAttr('disabled');
    }
    else{
      $('#roleNameEdit').attr("disabled","disabled");
    }
  }
  function InputRoleName_readonly() {
    $('#roleNameEdit').attr("disabled","disabled");
  }
  // /ROLE NAME EDITABILITY

  // VIEW
  view_role_modal_invoke = (role_id) => {
    //Form payload
    var formData = new FormData();
    formData.append('role_id',role_id);

    //View role get details
    $.ajax({
      headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/viewUserRoleGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $('#btnViewUserRole-'+role_id).attr('disabled', 'disabled');
        $("#spinnerBtnViewUserRole-"+role_id).removeClass('d-none');
      },
      success: function(data){
        console.log('Success in view role get details ajax.');
        $("#spinnerBtnViewUserRole-"+role_id).addClass('d-none');
        $('#btnViewUserRole-'+role_id).removeAttr('disabled', 'disabled');
        $('#permissionList').html("");
        if(data['status'] == 'success'){
          let icon = "";
          $.each(data['arrayPermissions'], function( index, value ) {
            if(value['permission_status'] == true){
              icon = "check";
            }else{
              icon = "times";
            }
            $('#permissionList').append("<div class='col-lg-3 col-md-6'><i class='fas fa-"+icon+ "'></i>" + value['permission_name'] +"</div>")
            //console.log( index + ": "+ value['permission_name']+ " : " + value['permission_status'] );
          });
          $('#modal-view-role').modal('show');
        }
      },
      error: function(err){
        console.log('Error in view role get details ajax.');
        $("#spinnerBtnViewUserRole-"+role_id).addClass('d-none');
        $('#btnViewUserRole-'+role_id).removeAttr('disabled', 'disabled');
      },
    })
  }
  // /VIEW

  // CREATE
  create_role = () => {
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
          url: "{{ url('/portal/staff/system/createUserRole') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateUserRole').attr('disabled','disabled');},
          success: function(data){
            console.log('success in create role ajax');
            $('#btnCreateUserRole').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('errors on validating data');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
              //SwalCancelWarning.fire({title: 'Role creation Aborted!',text: 'You have no permission to create a role',})
            }
            else if(data['status'] == 'success'){
              console.log('create role is success');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'User role created.',
                })
                $('#modal-create-role').modal('hide')
                location.reload();
            }
          },
          error: function(err){
            $('#btnCreateUserRole').removeAttr('disabled','disabled');
            console.log('error in create role ajax');
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
  // /CREATE

  // EDIT
  edit_role_modal_invoke = (role_id) =>{

    //Form payload
    var formData = new FormData();
    formData.append('role_id',role_id);

    //View role get details
    $.ajax({
      headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/viewUserRoleGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $('#btnEditUserRole-'+role_id).attr('disabled', 'disabled');
        $("#spinnerBtnEditUserRole-"+role_id).removeClass('d-none');
      },
      success: function(data){
        console.log('Success in Edit role get details ajax.');
        $("#spinnerBtnEditUserRole-"+role_id).addClass('d-none');
        $('#btnEditUserRole-'+role_id).removeAttr('disabled', 'disabled');
        $('#permissionListEdit').html("");
        if(data['status'] == 'success'){
          $('#roleNameEdit').val(data['role']['name']);
          $('#modal-edit-role-title').html(data['role']['name']);
          let status = "";
          $.each(data['arrayPermissions'], function( index, value ) {
            if(value['permission_status'] == true){
              status = 'checked';
            }else{
              status = "";
            }
            //$('#permissionListEdit').append("<div class='col-lg-3 col-md-6'><input type='checkbox' name='permissionId-"+value['permission_id'] +"' "+status+" /> " + value['permission_name'] +"</div>")
            $('#permissionListEdit').append("<div class='col-lg-3 col-md-6'><input type='checkbox' name='permissionId-"+value['permission_id'] +"' value='"+ value['permission_id'] +"' "+status+" /> " + value['permission_name'] +"</div>")
            //console.log( index + ": "+ value['permission_name']+ " : " + value['permission_status'] );
          });
          $('#roleNameEdit').attr("disabled","disabled");
          $('#btnEditUserRolePermissions').attr('onclick', "edit_role("+role_id+")");
          $('#modal-edit-role').modal('show');
        }
      },
      error: function(err){
        console.log('Error in Edit role get details ajax.');
        $("#spinnerBtnEditUserRole-"+role_id).addClass('d-none');
        $('#btnEditUserRole-'+role_id).removeAttr('disabled', 'disabled');
      },
    })
  }

  edit_role = (role_id) => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {

        //From payload
        var formData = new FormData($('#formEditRole')[0]);
        formData.append('role_id', role_id);
        formData.append('role_name', $('#roleNameEdit').val());

        //UPDATE PERMISSIONS AJAX
        $.ajax({
          headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editUserRolePermissions') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){
            $('#btnEditUserRolePermissions').attr('disabled', 'disabled');
            $("#spinnerBtnEditUserRolePermissions").removeClass('d-none');
          },
          success: function(data){
            console.log('Success in Edit role update permissions ajax.');
            $("#spinnerBtnEditUserRolePermissions").addClass('d-none');
            $('#btnEditUserRolePermissions').removeAttr('disabled', 'disabled');
            if(data['status'] == 'success'){
              SwalDoneSuccess.fire({title: 'Updated!',text: 'User role has been updated.',})
              .then((result) => {if (result.isConfirmed) {location.reload()}});
            }
          },
          error: function(err){
            console.log('Error in Edit role update permissions ajax.');
            $("#spinnerBtnEditUserRolePermissions").addClass('d-none');
            $('#btnEditUserRolePermissions').removeAttr('disabled', 'disabled');
          },
        })
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'User role has not been updated.',
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_role = (role_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // PAYLOAD
        var formData = new FormData;
        formData.append('role_id', role_id)

        //DELETE ROLE CONTROLLER
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/deleteUserRole') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteUserRole-'+role_id).attr('disabled','disabled');},
          success: function(data){
            console.log('success : delete user role ajax');
            $('#tbl-userRole-tr-'+role_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'User role has been deleted.',
            })
          },
          error: function(err){
            console.log('error : delete user role ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'User role has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /USER ROLE

// SUBJECT
  // CREATE
  create_subject = () => {
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
        //Get form data
        var formData = new FormData($('#formCreateSubject')[0]);

        //Validate infromation
        $.ajax({
          headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/createSubject') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateSubject').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in create subject ajax.');
            $('#btnCreateSubject').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('Errors on validating data.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is=invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Create subject is success');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Subject created.',
              })
              $('#modal-create-subject').modal('hide');
              location.reload();
            }
          },
          error: function(err){
            $('#btnCreateSubject').removeAttr('disabled','disabled');
            console.log('Error in create subject ajax.')
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_subject_modal_invoke = (subject_id) => {
    //Form payload
    var formData = new FormData();
    formData.append('subject_id',subject_id);

    //Edit subject get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editSubjectGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditSubject-'+subject_id).attr('disabled','disabled');},
      success: function(data){
        console.log('Success in edit subject get details ajax.');
        if(data['status'] == 'success'){
          $('#modal_edit_subject_title').html(data['subject']['name']);
          $('#subjectId').val(data['subject']['id']);
          $('#subjectCode').val(data['subject']['code']);
          $('#subjectName').val(data['subject']['name']);
          $('#modal-edit-subject').modal('show');
          $('#btnEditSubject-'+subject_id).removeAttr('disabled','disabled');
        }
      },
      error: function(err){
        console.log('Error in edit subject get details ajax.');
        $('#btnEditSubject-'+subject_id).removeAttr('disabled','disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_subject = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form pyload
        var formData = new FormData($('#formEditSubject')[0]);

        //Edit subject
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editSubject') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditSubject').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit subject ajax.');
            $('#btnModalEditSubject').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating edit subject data.');
              $('small').hide();
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit subject.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Subject has been updated.',
              })
              $('#modal-edit-subject').modal('hide')
              location.reload();
            }
          },
          error: function(err){
            $('#btnModalEditSubject').removeAttr('disabled', 'disabled');
            console.log('Error in edit subject ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been updated.',
        })
      }
    })
  }
  // /EDIT

  //DELETE
  delete_subject = (subject_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Payload
        var formData = new FormData();
        formData.append('subject_id',subject_id);

        //Delete subject controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/deleteSubject') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteSubject-'+subject_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success in delete subject ajax.');
            $('#tbl-subject-tr-'+subject_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Subject has been deleted.',
            })
          },
          error: function(err){
            console.log('Error in delete subjecr ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /SUBJECT

// EXAM_TYPE
  // CREATE
  create_exam_type = () => {
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
        //Payload
        var formData = new FormData($('#formCreateExamType')[0]);

        //Validate information
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/createExamType') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateExamType').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in create exam type ajax.');
            $('#btnCreateExamType').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating data.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Create role is success');
              SwalDoneSuccess.fire({
              title: 'Created!',
              text: 'Exam Type created.',
              })
              $('#modal-create-exam-type').modal('hide')
              location.reload();
              }
          },
          error: function(err){
            $('#btnCreateExamType').removeAttr('disabled', 'disabled');
            console.log('Error in creare exam type ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam Type has not been created.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_exam_type_modal_invoke = (exam_type_id) => {
    //Form payload
    var formData = new FormData();
    formData.append('exam_type_id',exam_type_id);

    //Edit exam type get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editExamTypeGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#bntEditExamType-'+exam_type_id).attr('disabled','disabled');},
      success: function(data){
        console.log('Success in edit exam type get details ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-exam-type-title').html(data['exam_type']['name']);
          $('#examTypeId').val(data['exam_type']['id']);
          $('#examTypeName').val(data['exam_type']['name']);
          $('#modal-edit-exam-type').modal('show');
          $('#bntEditExamType-'+exam_type_id).removeAttr('disabled','disabled');
        }
      },
      error: function(err){
        console.log('Error in edit exam type get details ajax.');
        $('#bntEditExamType-'+exam_type_id).removeAttr('disabled','disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_exam_type = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.from-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //From payload
        var formData = new FormData($('#formEditExamType')[0]);

        //Edit exam type
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editExamType') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditExamType').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit exam type ajax.');
            $('#btnModalEditExamType').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating data.');
              $('small').hide();
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit exam type.')
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Exam type has been updated.',
              })
              $('#modal-edit-exam-type').modal('hide')
              location.reload();
            }
          },
          error: function(err){
            console.log('Error in edit exam type ajax.');
            $('#btnModalEditExamType').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Subject has not been updated.',
        })
      }
    })
  }
  // /EDIT

  //DELETE
  delete_exam_type = (exam_type_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // Payload
        var formData = new FormData();
        formData.append('exam_type_id',exam_type_id);

        //Delete exam type controller
        $.ajax({
          headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/deleteExamType') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteExamType-'+exam_type_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success in delete exam type ajax.');
            $('#tbl-examType-tr-'+exam_type_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Exam type has been deleted.',
            })
          },
          error: function(err){
            console.log('Error in delete exam type ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam type has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /EXAM_TYPE

// STUDENT PHASE
  // CREATE
  create_student_phase = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //remove past validation messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();

        //Form Data
        var formData = new FormData($("#formCreatePhase")[0]);

        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/createStudentPhase') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreatePhase').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in create phase ajax');
            $('#btnCreatePhase').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('Errors on validating data.');
              $.each(data['errors'], function(key, value){
                $('.form-text').hide();
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Create phase is success.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Student Phase created.',
              })
              $('#modal-create-student-phase').modal('hide')
              location.reload();
            }
          },
          error: function(err){
            $('#btnCreatePhase').removeAttr('disabled','disabled');
            console.log('Error in create phase ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Student Phase creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_student_phase_modal_invoke = (student_phase_id) => {
    //Form payload
    var formData = new FormData();
    formData.append('student_phase_id',student_phase_id);

    //Edit student phase get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editStudentPhaseGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditStudentPhase-'+student_phase_id).attr('disabled', 'disabled');},
      success: function(data){
        console.log('Success in edit student phase get details ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-student-phase-title').html(data['student_phase']['name']);
          $('#phaseId').val(data['student_phase']['id']);
          $('#phaseCode').val(data['student_phase']['code']);
          $('#phaseName').val(data['student_phase']['name']);
          $('#phaseDescription').val(data['student_phase']['description']);
          $('#modal-edit-student-phase').modal('show');
          $('#btnEditStudentPhase-'+student_phase_id).removeAttr('disabled','disabled');
        }
      },
      error: function(err){
        console.log('Error in edit student phase get details ajax.');
        $('#btnEditStudentPhase-'+student_phase_id).removeAttr('disabled','disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_student_phase = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedaback').hide();
        //Form payload
        var formData = new FormData($('#formEditStudentPhase')[0]);

        //Edit student phase
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editStudentPhase') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditStudentPhase').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit student phase ajax.');
            $('#btnModalEditStudentPhase').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating student phase data.');
              $('small').hide();
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit student phase.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Student phase has been updated.',
              })
              $('#modal-edit-student-phase').modal('hide')
              location.reload();
            }
          },
          error: function(err){
            console.log('Error in edit student phase ajax.')
            $('#btnModalEditStudentPhase').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Student phase has not been updated.',
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_student_phase = (phase_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Payload
        var formData = new FormData();
        formData.append('phase_id',phase_id);

        //Delete student phase controller
        $.ajax({
          headers: {'X-CSRF-token' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/deleteStudentPhase') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteStudentPhase-'+phase_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success in delete student phase ajax.');
            $('#tbl-studentPhase-tr-'+phase_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Student phase has been deleted.',
            })
          },
          error: function(err){
            console.log('Error in delete student phase ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Student phase has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /STUDENT PHASE

// PAYMENT METHOD
  // CREATE
  create_payment_method = () => {
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
        var formData = new FormData($("#formCreatePaymentMethod")[0]);

        //Validate information
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/createPaymentMethod') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreatePaymentMethod').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in create payment method ajax.');
            $('#btnCreatePaymentMethod').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('Errors on validating data');
              $('small').hide();
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
              //SwalCancelWarning.fire({title: 'Role creation Aborted!',text: 'You have no permission to create a role',})
            }
            else if(data['status'] == 'success'){
              console.log('Success in create payment method.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Payment method created.',
                })
                $('#modal-create-payment-method').modal('hide')
                location.reload();
            }
          },
          error: function(err){
            $('#btnCreatePaymentMethod').removeAttr('disabled','disabled');
            console.log('Error in create payment method ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment method creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_payment_method_modal_invoke = (payment_method_id) =>{
    //Form payload
    var formData = new FormData();
    formData.append('payment_method_id', payment_method_id);

    //Edit payment method get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editPaymentMethodGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditPaymentMethod-'+payment_method_id).attr('disabled', 'disabled');},
      success: function(data){
        console.log('Success in edit payment method get details ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-payment-method-title').html(data['payment_method']['name']);
          $('#paymentMethodId').val(data['payment_method']['id']);
          $('#paymentMethodName').val(data['payment_method']['name']);
          $('#modal-edit-payment-method').modal('show');
          $('#btnEditPaymentMethod-'+payment_method_id).removeAttr('disabled', 'disabled');
        }
      },
      error: function(err){
        console.log('Error in edit payment method ajax.');
        $('#btnEditPaymentMethod-'+payment_method_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_payment_method = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form payload
        var formData = new FormData($('#formEditPaymentMethod')[0]);

        //Edit payment method
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editPaymentMethod') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditPaymentMethod').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit payment method ajax.');
            $('#btnModalEditPaymentMethod').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating edit payment method data.');
              $('small').hide();
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit payment method.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Payment method has been updated.',
              })
              $('#modal-edit-payment-method').modal('hide')
              location.reload();
            }
          },
          error: function(err){
            console.log('Error in edit payment method ajax.');
            $('#btnModalEditPaymentMethod').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        }); 
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment method has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_payment_method = (payment_method_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // PAYLOAD
        var formData = new FormData;
        formData.append('payment_method_id', payment_method_id)

        //DELETE PAYMENT METHOD CONTROLLER
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/deletePaymentMethod') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeletePaymentMethod-'+payment_method_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success : delete payment method ajax.');
            $('#tbl-paymentMethod-tr-'+payment_method_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Payment method has been deleted.',
            })
          },
          error: function(err){
            console.log('Error : delete payment method ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment method has not been deleted.',
        })
      }
    })
  }    
  // /DELETE
// /PAYMENT METHOD

// PAYMENT TYPE
  // CREATE
  create_payment_type = () => {
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
        var formData = new FormData($("#formCreatePaymentType")[0]);

        //Validate information
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/createPaymentType') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreatePaymentType').attr('disabled','disabled');},
          success: function(data){
            console.log('Success : create payment type ajax.');
            $('#btnCreatePaymentType').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('errors on validating data');
              $('small').hide();
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
              //SwalCancelWarning.fire({title: 'Role creation Aborted!',text: 'You have no permission to create a role',})
            }
            else if(data['status'] == 'success'){
              console.log('Success: create payment type.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Payment type created.',
                })
                $('#modal-create-payment-type').modal('hide')
                location.reload();
            }
          },
          error: function(err){
            $('#btnCreatePaymentType').removeAttr('disabled','disabled');
            console.log('Error : create payment type ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment type creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_payment_type_modal_invoke = (edit_payment_type_id) => {
    //Form payload
    var formData = new FormData();
    formData.append('edit_payment_type_id',edit_payment_type_id);

    //Edit payment type get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editPaymentTypeGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditPaymentType-'+edit_payment_type_id).attr('disabled', 'disabled');},
      success: function(data){
        console.log('Success in edit payment type get details ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-payment-type-title').html(data['edit_payment_type']['name']);
          $('#paymentTypeId').val(data['edit_payment_type']['id']);
          $('#paymentTypeName').val(data['edit_payment_type']['name']);
          $('#modal-edit-payment-type').modal('show');
          $('#btnEditPaymentType-'+edit_payment_type_id).removeAttr('disabled', 'disabled');
        }
      },
      error: function(err){
        console.log('Érror in edit payment type get details ajax.');
        $('#btnEditPaymentType-'+edit_payment_type_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_payment_type = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form payload
        var formData = new FormData($('#formEditPaymentType')[0]);

        //Edit payment type
        $.ajax({
          headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editPaymentType') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditPaymentType').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit payment type ajax.');
            $('#btnModalEditPaymentType').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating edit payment type data.');
              $('small').hide();
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit payment type.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Payment type has been updated.',
              })
              $('#modal-edit-payment-type').modal('hide')
              location.reload();
            }
          },
          error: function(err){
            console.log('Error in edit payment type ajax.');
            $('#btnModalEditPaymentType').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment type has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_payment_type = (payment_type_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // PAYLOAD
        var formData = new FormData;
        formData.append('payment_type_id', payment_type_id)

        //DELETE ROLE CONTROLLER
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/deletePaymentType') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeletePaymentType-'+payment_type_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success : delete payment type ajax');
            $('#tbl-paymentType-tr-'+payment_type_id).remove();
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Payment type has been deleted.',
            })
          },
          error: function(err){
            console.log('Error : delete payment type ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Payment type has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /PAYMENT TYPE
</script>