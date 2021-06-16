<script type="text/javascript">



  $(function () {
  
    var table = $('.user-list-yajradt').DataTable({
      searching: false,
      processing: true,
      serverSide: true,
      ajax: {
        url :"{{ route('user.list') }}",
        data : function (d) {
          d.name = $('#name').val();
          d.search = $('#searchAll').val();
          d.email = $('#email').val();
          d.role = $('#role').val();
          d.status = $('#status').val();
        }
      },
      columns: [
        {
          data: 'name', 
          name: 'name'
        },
        {
          data: 'email', 
          name: 'email'
        },
        {
          data: 'role_name', 
          name: 'role_name'
        },
        {
          data: 'status', 
          name: 'status'
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
          targets: 3,
          render: function ( data, type, row ) {
            var color = 'success';
            var status = 'Active';
            if (data == 1) {
              color = 'success';
              status = 'Active';
            } 
            else {
              color = 'danger';
              status = 'Deactive';
            }
            return '<span class="text-'+color+' font-weight-bold">'+status+'</span>';
          }
        },
        {
            targets: 4,
            render: function ( data, type, row ) {
                var button = '@if(Auth::user()->hasPermission("staff-user-profile-view"))<a onclick="view_profile('+data+');" title="View Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>@endif'
                return button;
            }
        }
      ]
    });

    search = () => {
        table.draw();

    }
  });

  add_user = () => {

    //Remove previous validation error messages
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').html('');
    $('.invalid-feedback').hide();

    //Form Payload
    var formData = new FormData($("#newUserForm")[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ route('add.new.user') }}",
      type: 'post',
      data:formData,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $('.btn').attr('disabled','disabled');
      },
      success: function(data){
        console.log('success in create role ajax');
        $('.btn').removeAttr('disabled','disabled');
        if(data['errors']){
          console.log('errors on validating data');
          $.each(data['errors'], function(key, value){
            $('#error-'+key).show();
            $('#'+key).addClass('is-invalid');
            $('#error-'+key).append('<strong>'+value+'</strong>');
          });
          //SwalCancelWarning.fire({title: 'Role creation Aborted!',text: 'You have no permission to create a role',})
        }
        else if(data['success'] == 'success'){
          console.log('create role is success');
          SwalDoneSuccess.fire({
            title: 'Created!',
            text: 'User role created.',
            }).then((result) => {
              $('#newUserModal').modal('hide')
              location.reload();

            });
        }
      },
      error: function(err){
        $('.btn').removeAttr('disabled','disabled');
        console.log('error in create role ajax');
        SwalSystemErrorDanger.fire();
      }
    });
  }

  view_profile = (id) => {
      var url = '{{ route("user.profile", ":id") }}';
      url = url.replace(':id', id);
      //    alert (id)
      let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1500,height=700,left=100,top=100`;
      //window.open( url,'User_Profile',params)
      window.open( url,'_blank');
  }
</script>