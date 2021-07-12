<!-- CREATE SCHEDULE -->

    <!-- EDIT -->
    <div class="modal fade" id="modal-edit-schedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal-edit-schedule-title" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-schedule-title">Edit Exam Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body">
                    <form id="formEditSchedule">
                        <div class="form-row align-items-center px-4">
                          <div class="form-group col-3">
                            <label for="editScheduleExam">Exam</label>
                            <input type="hidden" class="form-control" id="editScheduleId" name="editScheduleId">
                            <span class="invalid-feedback" id="error-editScheduleId" role="alert"></span>
                            <select name="editScheduleExam" id="editScheduleExam" class="form-control">
                                <option value="" selected>Select Exam</option>
                                @foreach ($upcoming_exams as $exam)
                                    <option value="{{$exam->id}}">{{$exam->year}} {{\Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleExam" role="alert"></span>
                          </div>
                          <div class="form-group col-3">
                            <label for="editScheduleSubject">Subejct</label>
                            <select name="editScheduleSubject" id="editScheduleSubject" class="form-control">
                                <option value="" selected>Select Subject</option>
                              @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleSubject" role="alert"></span>
                          </div>
                          <div class="form-group col-3">
                            <label for="editScheduleExamType">Exam Type</label>
                            <select name="editScheduleExamType" id="editScheduleExamType" class="form-control">
                                <option value="" selected>Select Exam Type</option>
                              @foreach ($exam_types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                              @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleExamType" role="alert"></span>
                          </div>
                          <div class="form-group col-3">
                            <label for="editScheduleExamDate">Date</label>
                            <input type="date" name="editScheduleExamDate" id="editScheduleExamDate" class="form-control"/>
                            <span class="invalid-feedback" id="error-editScheduleExamDate" role="alert"></span>
                          </div>
                          <div class="form-group col-3">
                            <label for="editScheduleStartTime">Start Time</label>
                            <input type="time" name="editScheduleStartTime" id="editScheduleStartTime" class="form-control"/>
                            <span class="invalid-feedback" id="error-editScheduleStartTime" role="alert"></span>
                          </div>
                          <div class="form-group col-3">
                            <label for="editScheduleEndTime">End Time</label>
                            <input type="time" name="editScheduleEndTime" id="editScheduleEndTime" class="form-control"/>
                            <span class="invalid-feedback" id="error-editScheduleEndTime" role="alert"></span>
                          </div>
                          <div class="form-group col-3 ">
                            <label for="editScheduleLab">Lab</label>
                            <select name="editScheduleLab" id="editScheduleLab" class="form-control">
                                <option value="" selected>Select Lab</option>
                                @foreach ($labs as $lab)
                                    <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" id="error-editScheduleLab" role="alert"></span>
                          </div>
                          <div class="form-group col-3">
                            <label for="editScheduleLabCapacity">Lab Capacity</label>
                            <input type="text" name="editScheduleLabCapacity" id="editScheduleLabCapacity" class="form-control">
                            <span class="invalid-feedback" id="error-editScheduleLabCapacity" role="alert"></span>
                          </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModalEditSchedule" onclick="edit_schedule();">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /EDIT -->

    {{-- SCHEDULE DECLINED MESSAGE --}}
    {{-- <div class="modal fade" id="modal-schedule-declined-message" data-backdrop="static" tabindex="-1" aria-labelledby="modal-schedule-declined-message-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 Schedule class="modal-title text-danger" id="modal-schedule-declined-message-title">Declined Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span name="scheduleDeclineMessage" id="scheduleDeclineMessage"></span>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- /SCHEDULE DECLINED MESSAGE --}}

<!-- /CREATE SCHEDULE -->


<!-- SCHEDULE TABLE -->

    <!-- POSTPONE-->
    <div class="modal fade" id="modal-postpone-schedule" data-backdrop="static" tabindex="-1" aria-labelledby="modal-postpone-schedule-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Postpone Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="card-header p-0" id="modal-postpone-schedule-title"></h5><br/>
                    <form id="formPostponeSchedule">
                        <div class="form-row align-items-center">
                            <div class="form-group col-xl-3 col-lg-6">
                                <label for="postponeExam">Exam</label>
                                <input type="hidden" class="form-control" id="postponeScheduleId" name="postponeScheduleId">
                                <select name="postponeExam" id="postponeExam" class="form-control">
                                    <option value="" selected>Select Exam</option>
                                    @foreach ($upcoming_exams as $exam)
                                        <option value="{{$exam->id}}">{{$exam->year}} {{\Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" id="error-postponeExam" role="alert"></span>
                              </div>
                            <div class="form-group col-xl-3 col-lg-6">
                                <label for="postponeExamDate">Date</label>
                                <input type="date" class="form-control" name="postponeExamDate" id="postponeExamDate" />
                                <span class="invalid-feedback" id="error-postponeExamDate" role="alert"></span>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4">
                                <label for="postponeExamStartTime">Start Time</label>
                                <input type="time" class="form-control" name="postponeExamStartTime" id="postponeExamStartTime" />
                                <span class="invalid-feedback" id="error-postponeExamStartTime" role="alert"></span>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4">
                                <label for="postponeExamEndTime">End Time</label>
                                <input type="time" class="form-control" name="postponeExamEndTime" id="postponeExamEndTime" />
                                <span class="invalid-feedback" id="error-postponeExamEndTime" role="alert"></span>
                            </div>
                            <div class="form-group col-xl-2 col-lg-4">
                                <label for="postponeExamLab">Lab</label>
                                <select name="postponeExamLab" id="postponeExamLab" class="form-control">
                                    <option value="" selected>Select Lab</option>
                                    @foreach ($labs as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" id="error-postponeExamLab" role="alert"></span>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" id="btnModalPostponeExam" onclick="postpone_exam();">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /POSTPONE -->

<!-- /SCHEDULE TABLE -->

{{-- ASSIGNED STUDENTS LIST OF AN EXAM --}}
<div class="modal fade" id="modal-view-schedule-assigned-students" data-bockdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewScheduleAssignedStudents" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dailog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewScheduleAssignedStudents">Assigned Students For The Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 scheduleAssignedStudents">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-5">
                                <div class="card-header">Schedule Details</div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Exam: </th>
                                            <td><span id="spaneScheduledExam"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Scheduled Date: </th>
                                            <td><span id="spaneScheduledDate"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Scheduled Time: </th>
                                            <td><span id="spaneScheduledTime"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Subejct: </th>
                                            <td><span id="spaneScheduledSubject"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Exam Type: </th>
                                            <td><span id="spaneScheduledExamType"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">Assigned Students</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 order-md-1 order-2">
                                            <table class="table tbl-assigned_student-list-yajradt">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Registration No</th>
                                                        <th>NIC/Postal/Passport</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>

</div>
{{-- /ASSIGNED STUDENTS LIST OF AN EXAM--}}