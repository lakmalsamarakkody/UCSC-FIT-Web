<!-- CREATE SHEDULE -->

    <!-- EDIT -->
    <div class="modal fade" id="editSchedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticEditSchedule" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticEditSchedule">Edit Exam Schedule</h5>
                    <button type="butoon" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="class-body">
                    <form>
                        <div class="form-row align-items-center px-4">
                          <div class="form-group col-xl-3 col-lg-6">
                            <label for="subject">Subejct</label>
                            <select name="subject" id="subject" class="form-control">
                              <option value="">ICT Applications</option>
                              <option value="">English for ICT</option>
                              <option value="">Mathematics for ICT</option>
                            </select>
                          </div>
                          <div class="form-group col-xl-3 col-lg-6">
                            <label for="examType">Exam Type</label>
                            <select name="examType" id="examType" class="form-control">
                              <option value="">e-Test</option>
                              <option value="">Practical</option>
                            </select>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="examDate">Date</label>
                            <input type="date" name="examDate" id="examDate" class="form-control"/>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="startTime">Start Time</label>
                            <input type="time" name="startTime" id="startTime" class="form-control"/>
                          </div>
                          <div class="form-group col-xl-2 col-lg-4">
                            <label for="endTime">End Time</label>
                            <input type="time" name="endTime" id="endTime" class="form-control"/>
                          </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" onclick="edit_schedule();">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /EDIT -->

<!-- /CREATE SHEDULE -->


<!-- SHEDULE TABLE -->

    <!-- POSTPONE-->
    <div class="modal fade" id="postponeExam" data-backdrop="static" tabindex="-1" aria-labelledby="postponeExamLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postponeExamLabel">Postpone Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row align-items-center">
                            <div class="form-group col-4">
                                <label for="examDate">Date</label>
                                <input type="date" class="form-control" name="examDate" id="examDate" />
                            </div>
                            <div class="form-group col-4">
                                <label for="startTime">Start Time</label>
                                <input type="time" class="form-control" name="startTime" id="startTime" />
                            </div>
                            <div class="form-group col-4">
                                <label for="endTime">End Time</label>
                                <input type="time" class="form-control" name="endTime" id="endTime" />
                            </div>

                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" onclick="postpone_exam()">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- /POSTPONE -->

<!-- /SHEDULE TABLE -->