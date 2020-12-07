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
          data: 'status', 
          name: 'status'
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