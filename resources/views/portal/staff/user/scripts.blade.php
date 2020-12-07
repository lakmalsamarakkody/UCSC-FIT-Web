<script type="text/javascript">
  $(function () {
  
    var table = $('.user-list-yajradt').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('user.list') }}",
      columns: [
        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {
          data: 'name', 
          name: 'Username',
          orderable: true, 
          searchable: true
        },
        {
          data: 'email', 
          name: 'Email',
          orderable: true, 
          searchable: true
        },
        {
          data: 'action', 
          name: 'action', 
          orderable: false, 
          searchable: false
        },
      ]
    });
  });
</script>