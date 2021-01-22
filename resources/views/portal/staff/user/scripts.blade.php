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
                var button = '<a onclick="view_profile('+data+');" title="View Profile" data-tooltip="tooltip"  data-placement="bottom"  type="button" class="btn btn-outline-primary"><i class="fas fa-user"></i></a>'
                return button;
            }
        }
      ]
    });

    search = () => {
        table.draw();

    }
  });

        view_profile = (id) => {
            var url = '{{ route("user.profile", ":id") }}';
            url = url.replace(':id', id);
            //    alert (id)
            let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1500,height=700,left=100,top=100`;
            window.open( url,'User_Profile',params)
        }
</script>