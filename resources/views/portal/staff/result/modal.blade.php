    <div class="modal fade" id="importResults" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticEditSchedule" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticEditSchedule">Import Results</h5>
                    <button type="butoon" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body p-5">
                    <form id="resultsImportForm">
                      <div class="form-row">
                        <div class="form-group col">
                          <label for="schedule">Exam Schedule</label>
                          <select id="schedule" name="schedule" class="form-control form-control-lg ">
                            <option value=""selected>Exam Schedule</option>
                            @foreach($schedules as $schedule)                          
                            <option value="{{ $schedule->id }}">{{ $schedule->year }} {{ $schedule->month }} - {{ $schedule->subject_code }} {{ $schedule->subject_name }} - {{ $schedule->exam_type }} - {{ $schedule->date }}</option>
                            @endforeach
                          </select>
                          <span id="errschedule" class="invalid-feedback" role="alert"></span>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col pt-5">
                          <label for="resultFile">Results File</label>
                          <div class="drop-zone">
                            <span class="drop-zone__prompt">Drop Results File here or click to upload</span>
                            <input type="file" name="resultFile" id="resultFile" class="drop-zone__input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
                          </div>
                            <span id="errresultFile" class="invalid-feedback" role="alert"></span>
                        </div>
                      </div>
                      
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button id="importTempResults" onclick="import_result()" type="button" class="btn btn-outline-primary">
                      Import
                      <span id="importTempResultsSpinner" class="spinner-border spinner-border-sm mb-2 d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reviewResults" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticEditSchedule" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticEditSchedule">Review Results</h5>
                    <button type="butoon" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body p-5">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-12">
                          <h5 id="nameHelp" class="form-text text-muted text-danger" style="color: red !important;">Please Re-Check if the schedule details are correct</h5>
                        </div>  
                        <div class="col-4"><h5 class="w-100">Exam: <strong>january 2021</strong> </h5></div>
                        <div class="col-4"><h5 class="w-100">Subject: <strong>103 ICT Applications</strong></h5></div>
                        <div class="col-4"><h5 class="w-100">Date: <strong>19-01-2021</strong></h5></div>
                        
                          
                          
                        
                      </div>
                      <div class="form-row">
                        <div class="form-group col pt-5">
                          <label for="resultFile">Results File</label>
                          <div class="overflow-auto w-100" style=" max-height: 500px;">
                            <table class="table" id="tempResultsTable">
                              <thead>
                                <tr>
                                  <th><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></th>
                                  <th>Name</th>
                                  <th>Reg Number</th>
                                  <th>NIC</th>
                                  <th>Grade/100.00</th>
                                </tr>
                              </thead>
                              <tbody>
                                <!-- <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr>
                                <tr>
                                  <td><input type="checkbox" class="assign-exam-check" name="assignCheck[]" value="'+data+'" /></td>
                                  <td>Kailee Kailee Fay Fay</td>
                                  <td>F2018119737</td>
                                  <td>232978105V</td>
                                  <td>85</td>
                                </tr> -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button onclick="import_result()" type="button" class="btn btn-outline-primary" onclick="">Import</button>
                </div>
            </div>
        </div>
    </div>