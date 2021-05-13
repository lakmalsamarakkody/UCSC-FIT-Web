@section('script')
<script type="text/javascript">

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

        var table1 = $('#tempResultsTable').DataTable({
            searching: false,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('get.temp.results') }}",
                data : function (d) {
                    d.year = $('#year').val();
                    d.month = $('#month').val();
                }
            },
            columns: [
                {
                    data: 'id', 
                    name: 'id'
                },
                {
                    data: 'student_reg_no', 
                    name: 'student_reg_no'
                },
                {
                    data: 'grade', 
                    name: 'grade', 
                    orderable: false, 
                    searchable: false
                },
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function(data, type, row) {
                    var checkBox = '<div class="input-group"><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></div>';
                    return checkBox;
                }

                }
            ]   
        });

        $('.form-control').on('change', function(){
            table.draw();
        });

      // IMPORT RESULTS
      import_result = () => {

        //Remove previous validation error messages
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        $('.invalid-feedback').hide();

        //Form payload
        var formData = new FormData($('#resultsImportForm')[0]);

        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: "{{ route('results.temp.import') }}",
          type: 'post',
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function()
          {
            $("#importTempResultsSpinner").removeClass('d-none');
            $('#importTempResults').attr('disabled', 'disabled');
          },
          success: function(data)
          {
            $("#importTempResultsSpinner").addClass('d-none');
            $('#importTempResults').removeAttr('disabled');
            if(data['errors']){
              $.each(data['errors'], function(key, value){
                $('#err'+key).show();
                $('#'+key).addClass('is-invalid');
                $('#err'+key).append('<strong>'+value+'</strong>')
              });
            }else if (data['success']){         
              $('#importResults').modal('hide')
              table1.draw();
              $('#reviewResults').modal('show')
            }else if (data['error']){
              SwalNotificationWarning.fire({
                title: 'Upload Failed!',
                text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
              })
            }
          },
          error: function(err)
          {
            $("#importTempResultsSpinner").addClass('d-none');
            $('#importTempResults').removeAttr('disabled');
            SwalNotificationWarning.fire({
              title: 'Upload Failed!',
              text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
            })
          }
        });
        // SwalQuestionSuccessAutoClose.fire({
        //   title: "Are you sure ?",
        //   text: "Results will be imported to the Database",
        //   confirmButtonText: "Yes, Send!",
        // })
        // .then((result) => {
        //   if (result.isConfirmed) {
        //     SwalNotificationSuccessAutoClose.fire({
        //       title: "Imported!",
        //       text: "Results imported",
        //     })
        //     $('#importResults').modal('hide')
        //     $('#reviewResults').modal('show')
        //   }
        //   else{
        //     SwalNotificationWarningAutoClose.fire({
        //       title: "Cancelled!",
        //       text: "Results not imported",
        //     })
        //   }
        // })
      }
      // /IMPORT RESULTS

  });
</script>
@endsection