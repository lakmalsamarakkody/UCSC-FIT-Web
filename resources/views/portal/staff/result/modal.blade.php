    <div class="modal fade" id="importResults" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticEditSchedule" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticEditSchedule">Import Results</h5>
                    <button type="butoon" class="close" aria-label="Close" onclick="location.reload()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body p-5">
                    <form id="resultsImportForm">
                      <div class="form-row">
                        <div class="form-group col">
                          <label for="schedule">Exam</label>
                          <select id="schedule" name="schedule" class="form-control form-control-lg ">
                            <option value=""selected>Exam</option>
                            @foreach($previous_exams as $exam)                          
                            <option value="{{$exam->id}}">{{$exam->year}} {{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName }}</option>
                            @endforeach
                          </select>
                          <span id="errschedule" class="invalid-feedback" role="alert"></span>
                        </div>
                        <div class="form-group col">
                          <label for="schedule">Subject</label>
                          <select id="schedule" name="schedule" class="form-control form-control-lg ">
                            <option value=""selected>Subject</option>
                            @foreach($subjects as $subject)                          
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                          </select>
                          <span id="errschedule" class="invalid-feedback" role="alert"></span>
                        </div>
                        <div class="form-group col">
                          <label for="schedule">Exam Type</label>
                          <select id="schedule" name="schedule" class="form-control form-control-lg ">
                            
                            @foreach($exam_types as $exam_type)                          
                            <option value="{{$exam_type->id}}">{{$exam_type->name}}</option>
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
                    <button type="button" class="btn btn-outline-secondary" onclick="location.reload()">Discard</button>
                    <button id="importTempResults" onclick="import_temp_result()" type="button" class="btn btn-outline-primary">
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
                    <button type="butoon" class="close" aria-label="Close"  onclick="discard()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body p-5">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-12">
                          <h5 id="nameHelp" class="form-text text-muted text-danger" style="color: red !important;">Please Re-Check if the schedule details are correct</h5>
                        </div>  
                        <div class="col-3"><h5 class="w-100">Exam: <strong><span class="modal-details" id="exam"></span></strong> </h5></div>
                        <div class="col-5"><h5 class="w-100">Subject: <strong><span class="modal-details" id="subject"></span></strong></h5></div>
                        <div class="col-4"><h5 class="w-100">Date: <strong><span class="modal-details" id="date"></span></strong></h5></div>
                        
                          
                          
                        
                      </div>
                      <div class="form-row">
                        <div class="form-group col pt-5">
                          <label for="resultFile">Results File</label>
                          <div class="w-100">
                            <table class="table w-100 display" id="tempResultsTable">
                              <thead>
                                <tr>
                                  <th class="text-center"><input type="checkbox" id="selectAllResults"/></th>
                                  <th>Name</th>
                                  <th>Reg Number</th>
                                  <th>NIC</th>
                                  <th>Grade/100.00</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="discard()">Discard</button>
                    <button id="importResults" onclick="import_result()" type="button" class="btn btn-outline-primary">
                      Import
                      <span id="importResultsSpinner" class="spinner-border spinner-border-sm mb-2 d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>