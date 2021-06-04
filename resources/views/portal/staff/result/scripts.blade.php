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
            scrollY:        "400px",
            scrollCollapse: true,
            paging:         false,
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
                    name: 'id',
                    orderable: false, 
                    searchable: false
                },
                {
                    data: 'full_name', 
                    name: 'full_name'
                },
                {
                    data: 'student_reg_no', 
                    name: 'student_reg_no'
                },
                {
                    data: 'nic_old', 
                    name: 'nic_old'
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
                      var checkBox = '<div class="input-group"><input type="checkbox" class="selected-results" name="assignCheck[]" value="'+data+'" /></div>';
                      return checkBox;
                  }

                },
                {
                    targets: 3,
                    render: function(data, type, row) {
                        var nic = null;
                        if(row['nic_old'] != null) {
                            nic = row['nic_old'];
                        }
                        if(row['nic_new'] != null) {
                            nic = row['nic_new'];
                        }
                        if(row['postal'] != null) {
                            nic = row['postal'];
                        }
                        if(row['passport'] != null) {
                            nic = row['passport'];
                        }
                        return nic;
                    }
                }
            ]   
        });

        $('.form-control').on('change', function(){
            table.draw();
        });

      $('#selectAllResults').on('change', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
      })

      // IMPORT TEMPORARY RESULTS
      import_temp_result = () => {

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
              var exam = $('#exam').val();   
              var subject = $('#subject').val();   
              var examType = $('#examType').val();   
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('get.temp.modal.details') }}",
                type: 'get',
                data: {
                  'exam': exam,
                  'subject': subject,
                  'examType': examType
                },
                success: function(data)
                {
                  // alert(data[0]['id'])
                  if (data[0]['id'] != null){  
                    // alert(data[0]['id'])
                    $('#examDetails').html( data[0]['month'] + ' '+ data[0]['year'] );
                    $('#subjectDetails').html( data[0]['subject_code'] +' '+ data[0]['subject_name'] );
                    $('#typeDetails').html( data[0]['exam_type'] );
                    $('#importResults').modal('hide');
                    table1.draw();
                    $('#reviewResults').modal('show')
                  }else{
                    alert('sfdfdf')
                  }
                },
                error: function(err)
                {
                  SwalNotificationWarning.fire({
                      title: 'Import Failed!',
                      text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                  })
                }
              });    
            }else if (data['error']){
              SwalNotificationWarning.fire({
                title: 'Import Failed!',
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
      }
      // /IMPORT TEMPORARY RESULTS


      // IMPORT RESULTS
      import_result = () => {

        SwalQuestionSuccessAutoClose.fire({
          title: "Are you sure ?",
          text: "Imported Results will be imported permanently",
          confirmButtonText: "Yes, Import!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            selectedResults = [];
            $('.selected-results').each(function() {
                if($(this).is(":checked")) {
                  selectedResults.push($(this).val());
                }
            });

            // Form Payload
            let formData = new FormData();
            var json_arr = JSON.stringify(selectedResults);
            formData.append('selectedResults', json_arr);

            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ route('results.import') }}",
              type: 'post',
              data: formData,              
              processData: false,
              contentType: false,
              beforeSend: function()
              {
                $("#importResultsSpinner").removeClass('d-none');
                $('#importResults').attr('disabled', 'disabled');
              },
              success: function(data)
              {
                $("#importResultsSpinner").addClass('d-none');
                $('#importResults').removeAttr('disabled');
                if (data['success']){  
                  SwalDoneSuccess.fire({
                    title: "Results Imported!",
                    text: "Imported results Successfully",
                  }).then((result1) => {
                      if (result.isConfirmed) {
                        location.reload()
                      }
                    })
                }else if (data['error']){
                  table1.draw()
                  SwalNotificationWarning.fire({
                    title: 'Import Failed!',
                    text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                  })
                }
              },
              error: function(err)
              {
                $("#importResultsSpinner").addClass('d-none');
                $('#importResults').removeAttr('disabled');
                SwalNotificationWarning.fire({
                    title: 'Import Failed!',
                    text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                })
              }
            });

          }
          else{
            SwalNotificationWarningAutoClose.fire({
              title: "Cancelled!",
              text: "Discard results aborted",
            })
          }
        })
      }
      // /IMPORT RESULTS

      // DISCARD TEMPORARY RESULTS
      discard = () => {
        SwalQuestionSuccessAutoClose.fire({
          title: "Are you sure ?",
          text: "Imported Results will be discarded permanently",
          confirmButtonText: "Yes, Discard!",
        })
        .then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ route('results.temp.discard') }}",
              type: 'get',
              success: function(data)
              {
                if (data['success']){  
                  SwalNotificationSuccessAutoClose.fire({
                    title: "Results Discarded!",
                    text: "Imported results discarded Successfully",
                  })
                  table1.draw();
                  $('#reviewResults').modal('hide')
                }else if (data['error']){
                  SwalNotificationWarning.fire({
                    title: 'Discard Failed!',
                    text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                  })
                }
              },
              error: function(err)
              {
                SwalNotificationWarning.fire({
                    title: 'Discard Failed!',
                    text: 'Please Try Again or Contact Administrator: admin@fit.bit.lk',
                })
              }
            });

          }
          else{
            SwalNotificationWarningAutoClose.fire({
              title: "Cancelled!",
              text: "Discard results aborted",
            })
          }
        })
      }
      // /DISCARD TEMPORARY RESULTS
  });
</script>
@endsection