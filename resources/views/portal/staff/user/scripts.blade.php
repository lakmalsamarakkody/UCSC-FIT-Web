<script type="text/javascript">
  $(function () {
  
    var table = $('.user-list-yajradt').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('user.list') }}",
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
  });

  view_user = () => {
    // alert('asda');
    window.open("{{ route('user.profile') }}", '_blank')
  }
</script>