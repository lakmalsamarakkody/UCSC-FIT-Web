<script type="text/javascript">

  let permissionTable = null;

  // BANK BRANCHES DATA TABLE
  $(document).ready(function(){$('#bankBranchTbl').DataTable();});

  // IMPORT STUDENT
  import_student = () => {

  SwalQuestionDangerAutoClose.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this import!",
    confirmButtonText: 'Yes, Import Data!',
    })
  .then((result) => {
    if (result.isConfirmed) {

      //Remove previous validation error messages
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').html('');
      $('.invalid-feedback').hide();

      //Form payload
      var formData = new FormData($('#studentImportForm')[0]);

      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('student.import') }}",
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function()
        {
          $("#importTempStudentSpinner").removeClass('d-none');
          $('#importTempStudent').attr('disabled', 'disabled');
        },
        success: function(data)
        {
          $("#importTempStudentSpinner").addClass('d-none');
          $('#importTempStudent').removeAttr('disabled');
          if(data['errors']){
            $.each(data['errors'], function(key, value){
              SwalNotificationWarning.fire({
                title: 'Import Failed!',
                text: key +' : '+value,
                showConfirmButton : true,
              })
              .then(() => {
                location.reload();
              })
            });
          }else if (data['status'] == 'success'){
            $('#importStudent').modal('hide');
            SwalDoneSuccess.fire({
              title: 'Import Finished!',
              text: 'Check database for further verification',
            }).then((result) => {
              if(result.isConfirmed) {location.reload()}
            });
          }else{
            SwalNotificationWarningAutoClose.fire({
              title: 'Import Failed!',
              text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
            })
            .then(() => {
              //location.reload();
            })
          }
        },
        error: function(err)
        {
          $("#importTempStudentSpinner").addClass('d-none');
          $('#importTempStudent').removeAttr('disabled');
          SwalNotificationWarningAutoClose.fire({
            title: 'Upload Failed!',
            text: 'Please Try Again or Contact Administrator: {{ App\Models\Contact::where('type', 'admin')->first()->email }}',
          })
          .then(() => {
            //location.reload();
          })
        }
      });
    }
    else{
      SwalNotificationWarningAutoClose.fire({
        title: 'Cancelled!',
        text: 'Import process cancelled.',
      })
      .then(() => {
        //location.reload();
      })
    }
  })
  }
  // /IMPORT STUDENT


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

  // CHANGE MODULES DROPDOWN ACCORDING TO PORTAL
  onchange_portal = () => {
    
    //ON CREATE MODAL
    if($('#newPortalName').val() == 'student') {
      $('#newPermissionModule').find('option').remove().end().append('<option value="" hidden selected>Select Permission Module</option>'+
          '<option value="dashboard">Dashboard</option>'+
          '<option value="information">Information</option>'+
          '<option value="exam">Exams</option>'+
          '<option value="result">Results</option></select>');
    }
    else if($('#newPortalName').val() == 'staff') {
      $('#newPermissionModule').find('option').remove().end().append('<option value="" hidden selected>Select Permission Module</option>'+
          '<option value="dashboard">Dashboard</option>'+
          '<option value="student">Students</option>'+
          '<option value="exam">Exams</option>'+
          '<option value="result">Results</option>'+
          '<option value="user">Users</option>'+
          '<option value="system">System</option>'+
          '<option value="website">Website</option></select>');
    }

    // ON EDIT MODAL
    if($('#portalName').val() == 'student') {
      $('#permissionModule').find('option').remove().end().append('<option value="" hidden selected>Select Permission Module</option>'+
          '<option value="dashboard">Dashboard</option>'+
          '<option value="information">Information</option>'+
          '<option value="exam">Exams</option>'+
          '<option value="result">Results</option></select>');
    }
    else if($('#portalName').val() == 'staff') {
      $('#permissionModule').find('option').remove().end().append('<option value="" hidden selected>Select Permission Module</option>'+
          '<option value="dashboard">Dashboard</option>'+
          '<option value="student">Students</option>'+
          '<option value="exam">Exams</option>'+
          '<option value="result">Results</option>'+
          '<option value="user">Users</option>'+
          '<option value="system">System</option>'+
          '<option value="website">Website</option></select>');
    }
  }
  // /CHANGE MODULES DROPDOWN ACCORDING TO PORTAL

  // CREATE
  create_permission = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "New permission will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-permission').modal('hide');
                  permissionTable.draw();
                }
              });
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

          onchange_portal();
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
    text: "Permission will be updated!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-permission').modal('hide');
                  permissionTable.draw();
                }
              });
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
    confirmButtonText: 'Yes, Delete it!',
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
            .then((result) => {
                if(result.isConfirmed) {permissionTable.draw();}
            });
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
          $('#modal-view-role-title').html(data['role']['name']);
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
    text: "New user role will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-role').modal('hide');
                  location.reload();
                }
              });
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
    text: "User role will be updated!",
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
    confirmButtonText: 'Yes, Delete it!',
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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'User role has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {$('#tbl-userRole-tr-'+role_id).remove();}});
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
    text: "New subject will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-subject').modal('hide');
                  location.reload();
                }
              });
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
    text: "Subject will be updated!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-subject').modal('hide');
                  location.reload();
                }
              });
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
    confirmButtonText: 'Yes, Delete it!',
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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Subject has been deleted.',
            })
            .then((result) => {if(result.isConfirmed) {$('#tbl-subject-tr-'+subject_id).remove();}});
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
    text: "New exam type will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-exam-type').modal('hide');
                  location.reload();
                }
              });
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
    text: "Exam type will be updated!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-exam-type').modal('hide');
                  location.reload();
                }
              });
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
          text: 'Exam type has not been updated.',
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
    confirmButtonText: 'Yes, Delete it!',
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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Exam type has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {$('#tbl-examType-tr-'+exam_type_id).remove();}
            });
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

// EXAM_DURATION
  // CREATE
  set_exam_duration = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure?",
      text: "Duration for the exam will be set.",
      confirmButtonText: 'Yes, Set Duration!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Payload
        var formData = new FormData($('#formCreateExamDuration')[0]);
        formData.append('newExamDurationHours', $('#newExamDurationHours').val());
        formData.append('newExamDurationMinutes', $('#newExamDurationMinutes').val());

        //Validate information
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('staff.system.exam.duration.create') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateExamDuration').attr('disabled','disabled');},
          success: function(data){
            console.log('Success in set exam duration ajax.');
            $('#btnCreateExamDuration').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating data.');
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'error') {
              console.log('Exam duration already exist error.');
              SwalSystemErrorDanger.fire({
                title: 'Already Exists!',
                text: data['msg'],
              })
            }
            else if(data['status'] == 'success'){
              console.log('Success in set exam duration.');
              SwalDoneSuccess.fire({
                title: 'Set!',
                text: 'Exam Duration set.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-exam-duration').modal('hide');
                  location.reload();
                }
              });
            }
          },
          error: function(err){
            $('#btnCreateExamDuration').removeAttr('disabled', 'disabled');
            console.log('Error in set exam duration ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam Duration has not been set.',
        })
      }
    })
  }
  // / CREATE

  //EDIT
  edit_exam_duration_invoke = (exam_duration_id) => {
    console.log('edit_exam_duration_invoked');
    $('#inputDurationHours-'+exam_duration_id).val($('#spanDurationHours-'+exam_duration_id).html());
    $('#inputDurationMinutes-'+exam_duration_id).val($('#spanDurationMinutes-'+exam_duration_id).html());
    $('#tdDuration-'+exam_duration_id).addClass('d-none');
    $('#tdDurationEdit-'+exam_duration_id).removeClass('d-none');
    $('#btnEditExamDuration-'+exam_duration_id).addClass('d-none');
    $('#btnSaveExamDuration-'+exam_duration_id).removeClass('d-none');
    $('#btnCancelExamDuration-'+exam_duration_id).removeClass('d-none');
  }

  edit_exam_duration_save = (exam_duration_id) => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "Exam duration will be updated!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.from-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();

        //From payload
        var formData = new FormData();
        formData.append('exam_duration_id',exam_duration_id);
        formData.append('exam_duration_hours',$('#inputDurationHours-'+exam_duration_id).val());
        formData.append('exam_duration_minutes',$('#inputDurationMinutes-'+exam_duration_id).val());

        //Edit exam type
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editExamDuration') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){
            $('#btnSaveExamDuration-'+exam_duration_id).attr('disabled', 'disabled');
            $('#btnCancelExamDuration-'+exam_duration_id).attr('disabled', 'disabled');
            $('#spinnerBtnSaveExamDuration-'+exam_duration_id).removeClass('d-none');
          },
          success: function(data){
            console.log('Success in edit exam duration ajax.');
            $('#btnSaveExamDuration-'+exam_duration_id).removeAttr('disabled', 'disabled');
            $('#btnCancelExamDuration-'+exam_duration_id).removeAttr('disabled', 'disabled');
            $('#spinnerBtnSaveExamDuration-'+exam_duration_id).addClass('d-none');
            if(data['status'] == 'error' && data['errors']){
              console.log('Errors in validating data.');
              $.each(data['errors'], function(key, value){
                SwalNotificationErrorDangerAutoClose.fire({
                  title : value,
                });
              });
              // $.each(data['errors'], function(key, value){
              //   $('#error-'+key).show();
              //   $('#'+key).addClass('is-invalid');
              //   $('#error-'+key).append('<strong>'+value+'</strong>');
              // });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit exam duration.')
              $('#spanDurationHours-'+exam_duration_id).html(data['hours']);
              $('#spanDurationMinutes-'+exam_duration_id).html(data['minutes']);
              $('#tdDurationEdit-'+exam_duration_id).addClass('d-none');
              $('#tdDuration-'+exam_duration_id).removeClass('d-none');
              $('#btnSaveExamDuration-'+exam_duration_id).addClass('d-none');
              $('#btnEditExamDuration-'+exam_duration_id).removeClass('d-none');
              $('#btnCancelExamDuration-'+exam_duration_id).addClass('d-none');
              SwalNotificationSuccessAutoClose.fire({
                title: 'Updated!',
                text: 'Exam duration updated successfully.',
              });
            }
            else{
              console.log('Error in edit exam duration function.')
              SwalSystemErrorDanger.fire();
            }
          },
          error: function(err){
            console.log('Error in edit exam duration ajax.');
            $('#btnSaveExamDuration-'+exam_duration_id).removeAttr('disabled', 'disabled');
            $('#btnCancelExamDuration-'+exam_duration_id).removeAttr('disabled', 'disabled');
            $('#spinnerBtnSaveExamDuration-'+exam_duration_id).addClass('d-none');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam duration has not been updated.',
        })
      }
    })
  }
  edit_exam_duration_cancel = (exam_duration_id) => {
    $('#tdDurationEdit-'+exam_duration_id).addClass('d-none');
    $('#tdDuration-'+exam_duration_id).removeClass('d-none');
    $('#btnSaveExamDuration-'+exam_duration_id).addClass('d-none');
    $('#btnCancelExamDuration-'+exam_duration_id).addClass('d-none');
    $('#btnEditExamDuration-'+exam_duration_id).removeClass('d-none');
  }
  // /EDIT

  // DELETE
  delete_exam_duration = (exam_duration_id) => {
    SwalQuestionDanger.fire({
      title: "Are you sure?",
      text: "You wont be able to revert this!",
      confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Payload
        var formData = new FormData();
        formData.append('exam_duration_id',exam_duration_id);

        //Delete exam duration controller
        $.ajax({
          headers: {'X-CSRF-token' : $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('staff.system.exam.duration.delete') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteExamDuration-'+exam_duration_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success in delete exam duration ajax.');
            if(data['status'] == 'success') {
              SwalDoneSuccess.fire({
                title: 'Deleted!',
                text: 'Exam duration has been deleted.',
              })
              .then((result) => {
                if(result.isConfirmed) {$('#tbl-examduration-tr-'+exam_duration_id).remove();}
              });
            }
            else if(data['status'] == 'errors') {
              $('#btnDeleteExamDuration-'+exam_duration_id).removeAttr('disabled','disabled');
              SwalSystemErrorDanger.fire();
            }
          },
          error: function(err){
            console.log('Error in delete exam duration ajax.');
            $('#btnDeleteExamDuration-'+exam_duration_id).removeAttr('disabled','disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Exam duration has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// /EXAM_DURATION

// STUDENT PHASE
  // CREATE
  create_student_phase = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "New student phase will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-student-phase').modal('hide');
                  location.reload();
                }
              });
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
    text: "Student phase will be updated!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-student-phase').modal('hide');
                  location.reload();
                }
              });
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
    confirmButtonText: 'Yes, Delete it!',
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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Student phase has been deleted.',
            })
            .then((result) => {
                if(result.isConfirmed) {$('#tbl-studentPhase-tr-'+phase_id).remove();}
            });
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
    text: "New payment method will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-payment-method').modal('hide');
                  location.reload();
                }
              });
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
    text: "Payment method will be updated!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-payment-method').modal('hide');
                  location.reload();
                }
              });
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
    confirmButtonText: 'Yes, Delete it!',
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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Payment method has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {$('#tbl-paymentMethod-tr-'+payment_method_id).remove();}
            });
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
    text: "New payment type will be created!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-payment-type').modal('hide');
                  location.reload();
                }
              }); 
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
    text: "Payment type will be updated!",
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
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-payment-type').modal('hide');
                  location.reload();
                }
              });
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
    confirmButtonText: 'Yes, Delete it!',
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
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Payment type has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {$('#tbl-paymentType-tr-'+payment_type_id).remove();}
            }); 
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

// LAB
  // CREATE
  create_lab = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: 'Are you sure?',
      text: 'New lab will be created!',
      confirmButtonText: 'Yes, Create!'
    })
    .then((result) => {
      if(result.isConfirmed) {
        //Remove past validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();

        //Form payload
        let formData = new FormData($('#formCreateLab')[0]);

        //Create lab controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('create.lab') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateLab').attr('disabled', 'disabled');},
          success: function(data) {
            console.log('Success in create lab ajax.');
            $('#btnCreateLab').removeAttr('disabled', 'disabled');
            if(data['errors']) {
              console.log('Errors in validating lab data.');
              $.each(data['errors'], function(key, value){
                $('.form-text').hide();
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success') {
              console.log('Success in create lab.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Lab created.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-lab').modal('hide');
                  location.reload();
                }
              });
            }
          },
          error: function(err){
            console.log('Error in creat lab ajax.');
            $('#btnCreateLab').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
        title: 'Cancelled!',
        text: 'Lab creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with lab details
  edit_lab_modal_invoke = (lab_id) => {
    //Form Payload
    let formData = new FormData();
    formData.append('lab_id', lab_id);

    $.ajax({
      headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
      url: "{{ route('edit.lab.details') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditLab-'+lab_id).attr('disabled', 'disabled');},
      success: function(data) {
        console.log('Success in edit lab get details ajax.');
        if(data['status'] == 'success'){
          $('#edit-lab-title').html('Edit Lab ' + data['lab']['name']);
          $('#labId').val(data['lab']['id']);
          $('#labCapacity').val(data['lab']['capacity']);
          $('#labStatus').val(data['lab']['status']);
          $('#modal-edit-lab').modal('show');
          $('#btnEditLab-'+lab_id).removeAttr('disabled', 'disabled');
        }
      },
      error: function(err) {
        console.log('Error in edit payment get details ajax');
        $('#btnEditLab-'+lab_id).removeAttr('disabled', 'disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with lab details

  edit_lab = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: 'Are you sure?',
      text: 'Lab will be updated!',
      confirmButtonText: 'Yes, Update!',
    })
    .then((result)=> {
      if(result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();

        //Form Payload
        let formData = new FormData($('#formEditLab')[0]);

        //Edit lab controller
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('edit.lab') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function() {$('#btnModalEditLab').attr('disabled', 'disabled');},
          success: function(data) {
            console.log('Success in edit lab ajax.');
            $('#btnModalEditLab').removeAttr('disabled', 'disabled');
            if(data['errors']) {
              console.log('Errors in validating lab data.');
              $.each(data['errors'], function(key, value) {
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success') {
              console.log('Success in edit lab.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Lab has been updated.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-lab').modal('hide');
                  location.reload();
                }
              });
            }
          },
          error: function(err) {
            console.log('Error in edit lab ajax.');
            $('#btnModalEditLab').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else {
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Lab has not been updated.',
        })
      }
    })
  }
  // /EDIT

  // DELETE
  delete_lab = (lab_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // PAYLOAD
        var formData = new FormData;
        formData.append('lab_id', lab_id)

        //DELETE ROLE CONTROLLER
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/deleteLab') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteLab-'+lab_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success : delete lab ajax');
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Lab has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {$('#tbl-lab-tr-'+lab_id).remove();}
            }); 
          },
          error: function(err){
            console.log('Error : delete lab ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'lab has not been deleted.',
        })
      }
    })
  }
  // /DELETE
  // /LAB

  // BANK
  // CREATE
  create_bank = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "New bank will be created!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form Payload
        var formData = new FormData($("#formCreateBank")[0]);

        //Validate information
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/createBank') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateBank').attr('disabled','disabled');},
          success: function(data){
            console.log('Success : create bank ajax.');
            $('#btnCreateBank').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('errors on validating data');
              $('small').hide();
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success: create bank.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Bank created.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-bank').modal('hide');
                  location.reload();
                }
              }); 
            }else{
              $('#btnCreateBank').removeAttr('disabled','disabled');
              console.log('Error : create bank controller.');
              SwalSystemErrorDanger.fire();
            }
          },
          error: function(err){
            $('#btnCreateBank').removeAttr('disabled','disabled');
            console.log('Error : create bank ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Bank creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_bank_modal_invoke = (bank_id) => {

    //Form payload
    var formData = new FormData();
    formData.append('bank_id',bank_id);

    //Edit Bank get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editBankGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditBank-'+bank_id).attr('disabled', 'disabled');},
      success: function(data){
        console.log('Success in edit Bank get details ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-bank-title').html(data['bank']['name']);
          $('#editBankId').val(data['bank']['id']);
          $('#editBankName').val(data['bank']['name']);
          $('#modal-edit-bank').modal('show');
          $('#btnEditBank-'+bank_id).removeAttr('disabled','disabled');
        }
      },
      error: function(err){
        console.log('Error in edit Bank get details ajax.');
        $('#btnEditBank-'+bank_id).removeAttr('disabled','disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_bank = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "Bank will be updated!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedaback').hide();
        //Form payload
        var formData = new FormData($('#formEditBank')[0]);

        //Edit Bank
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editBank') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditBank').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit Bank ajax.');
            $('#btnModaleditBank').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating Bank data.');
              $('small').hide();
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit Bank.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Bank has been updated.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-bank').modal('hide');
                  location.reload();
                }
              });
            }
            else{
              console.log('Error in edit Bank controller.')
              $('#btnModaleditBank').removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          },
          error: function(err){
            console.log('Error in edit Bank ajax.')
            $('#btnModaleditBank').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Bank has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_bank = (bank_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // PAYLOAD
        var formData = new FormData;
        formData.append('bank_id', bank_id)

        //DELETE ROLE CONTROLLER
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/deleteBank') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnDeleteBank-'+bank_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success : delete Bank ajax');
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Bank has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {$('#tbl-bank-tr-'+bank_id).remove();}
            }); 
          },
          error: function(err){
            console.log('Error : delete Bank ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Bank has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// BANK

// BANK BRANCH
  // CREATE
  create_bank_branch = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "New bank branch will be created!",
    confirmButtonText: 'Yes, Create!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();
        //Form Payload
        var formData = new FormData($("#formCreateBankBranch")[0]);

        //Validate information
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/createBankBranch') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnCreateBankBranch').attr('disabled','disabled');},
          success: function(data){
            console.log('Success : create bankBranch ajax.');
            $('#btnCreateBankBranch').removeAttr('disabled','disabled');
            if(data['errors']){
              console.log('errors on validating data');
              $('small').hide();
              $.each(data['errors'], function(key, value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success: create bank branch.');
              SwalDoneSuccess.fire({
                title: 'Created!',
                text: 'Bank Branch created.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-create-bank-branch').modal('hide');
                  location.reload();
                }
              }); 
            }else{
              $('#btnCreateBankBranch').removeAttr('disabled','disabled');
              console.log('Error : create bank branch controller.');
              SwalSystemErrorDanger.fire();
            }
          },
          error: function(err){
            $('#btnCreateBankBranch').removeAttr('disabled','disabled');
            console.log('Error : create bank branch ajax.');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Bank Branch creation cancelled.',
        })
      }
    })
  }
  // /CREATE

  // EDIT
  // Fill modal with relevant data
  edit_bank_branch_modal_invoke = (bank_branch_id) => {

    //Form payload
    var formData = new FormData();
    formData.append('bank_branch_id',bank_branch_id);

    //Edit Bank Branch get details
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ url('/portal/staff/system/editBankBranchGetDetails') }}",
      type: 'post',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){$('#btnEditBankBranch-'+bank_branch_id).attr('disabled', 'disabled');},
      success: function(data){
        console.log('Success in edit Bank branch get details ajax.');
        if(data['status'] == 'success'){
          $('#modal-edit-bank-branch-title').html(data['bank_branch']['name']);
          $('#editBankBranchId').val(data['bank_branch']['id']);
          $('#editBankBranchBank').val(data['bank_branch']['bank_id']);
          $('#editBankBranchDistrict').val(data['bank_branch']['district_id']);
          $('#editBankBranchCode').val(data['bank_branch']['code']);
          $('#editBankBranchName').val(data['bank_branch']['name']);
          $('#modal-edit-bank-branch').modal('show');
          $('#btnEditBankBranch-'+bank_branch_id).removeAttr('disabled','disabled');
        }
      },
      error: function(err){
        console.log('Error in edit Bank Branch get details ajax.');
        $('#btnEditBankBranch-'+bank_branch_id).removeAttr('disabled','disabled');
        SwalSystemErrorDanger.fire();
      }
    });
  }
  // /Fill modal with relevant data

  edit_bank_branch = () => {
    SwalQuestionSuccessAutoClose.fire({
    title: "Are you sure?",
    text: "Branch will be updated!",
    confirmButtonText: 'Yes, Update!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedaback').hide();
        //Form payload
        var formData = new FormData($('#formEditBankBranch')[0]);

        //Edit Bank
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ url('/portal/staff/system/editBankBranch') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btnModalEditBankBranch').attr('disabled', 'disabled');},
          success: function(data){
            console.log('Success in edit Bank bank branch ajax.');
            $('#btnModaleditBankBranch').removeAttr('disabled', 'disabled');
            if(data['errors']){
              console.log('Errors in validating Bank data.');
              $('small').hide();
              $.each(data['errors'], function(key,value){
                $('#error-'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#error-'+key).append('<strong>'+value+'</strong>');
              });
            }
            else if(data['status'] == 'success'){
              console.log('Success in edit Bank.');
              SwalDoneSuccess.fire({
                title: 'Updated!',
                text: 'Branch has been updated.',
              })
              .then((result) => {
                if(result.isConfirmed) {
                  $('#modal-edit-bank-branch').modal('hide');
                  location.reload();
                }
              });
            }
            else{
              console.log('Error in edit Branch controller.')
              $('#btnModaleditBankBranch').removeAttr('disabled', 'disabled');
              SwalSystemErrorDanger.fire();
            }
          },
          error: function(err){
            console.log('Error in edit Bank branch ajax.')
            $('#btnModaleditBankBranch').removeAttr('disabled', 'disabled');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Branch has not been updated.',
        })
      }
    })
  }
  // /EDIT
  // DELETE
  delete_bank_branch = (bank_branch_id) => {
    SwalQuestionDanger.fire({
    title: "Are you sure?",
    text: "You wont be able to revert this!",
    confirmButtonText: 'Yes, Delete it!',
    })
    .then((result) => {
      if (result.isConfirmed) {
        // PAYLOAD
        var formData = new FormData;
        formData.append('bank_branch_id', bank_branch_id)

        //DELETE ROLE CONTROLLER
        $.ajax({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ url('/portal/staff/system/deleteBankBranch') }}",
          type: 'post',
          data:formData,
          processData: false,
          contentType: false,
          beforeSend: function(){$('#btndeleteBankBranch-'+bank_branch_id).attr('disabled','disabled');},
          success: function(data){
            console.log('Success : delete Bank branch ajax');
            SwalDoneSuccess.fire({
              title: 'Deleted!',
              text: 'Branch has been deleted.',
            })
            .then((result) => {
              if(result.isConfirmed) {location.reload();}
            }); 
          },
          error: function(err){
            console.log('Error : delete Bank Branch ajax');
            SwalSystemErrorDanger.fire();
          }
        });
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: 'Cancelled!',
          text: 'Bank Branch has not been deleted.',
        })
      }
    })
  }
  // /DELETE
// BANK

</script>