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
            var color = 'success';
            var status = 'Active';
            if (data == 1) {
              color = 'success';
              status = 'Active';
            } 
            else {
              color = 'danger';
              status = 'Inactive';
            }
            return '<span class="text-'+color+' font-weight-bold">'+status+'</span>';
          }
        },
      ]
    });

    search = () => {
        table.draw();

    }
  });

  view_user = () => {
    // alert('asda');
    window.open("{{ route('user.profile') }}", '_blank')
  }
</script>