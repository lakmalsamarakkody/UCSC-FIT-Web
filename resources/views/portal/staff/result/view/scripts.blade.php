@section('script')
<script type="text/javascript">
  $(function () {

     var table = $('.yajra-datatable').DataTable({
     });

  });

    view_student = (id) => {
      var url = '{{ route("student.profile", ":id") }}';
      url = url.replace(':id', id);
      window.open( url,'Student_Profile')
    }
</script>
@endsection