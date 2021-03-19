@section('script')
<script type="text/javascript">
  // PASSWORD
  import_result = () => {
    SwalQuestionSuccessAutoClose.fire({
      title: "Are you sure ?",
      text: "Results will be imported to the Database",
      confirmButtonText: "Yes, Send!",
    })
    .then((result) => {
      if (result.isConfirmed) {
        SwalNotificationSuccessAutoClose.fire({
          title: "Imported!",
          text: "Results imported",
        })
        $('#importResults').modal('hide')
      }
      else{
        SwalNotificationWarningAutoClose.fire({
          title: "Cancelled!",
          text: "Results not imported",
        })
      }
    })
  }
  // /PASSWORD
  $(function () {
      
        var table = $('.yajra-datatable').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('results.exam.list') }}",
                data : function (d) {
                    d.year = $('#year').val();
                    d.month = $('#month').val();
                }
            },
            columns: [
                {
                    data: 'year', 
                    name: 'year'
                },
                {
                    data: 'month', 
                    name: 'month'
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
                    targets: 2,
                    render: function ( data, type, row ) {
                        var button = '<a class="btn btn-outline-success w-100 text-center" href="{{ route("results.view", ":id") }}" target="_blank"><i class="fa fa-eye"></i>&nbsp;View Results</a>'
                        button = button.replace(':id', data);
                        return button;
                    }

                }
            ]   
        });

        $('.form-control').on('change', function(){
            table.draw();
        });

    

  });
</script>
@endsection