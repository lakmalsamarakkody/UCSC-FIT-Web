<!-- CREATE SHEDULE -->

    <!-- EDIT -->
    <div class="modal fade" id="editShedule" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticEditExam" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticEditShedule">Edit Exam Shedule</h5>
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
                          <div class="form-group col-xl-3 col-lg-6">
                            <label for="examDate">Date</label>
                            <input type="date" name="examDate" class="form-control"/>
                          </div>
                          <div class="form-group col-xl-2 col-lg-6">
                            <label for="startTime">Start Time</label>
                            <input type="time" name="startTime" class="form-control"/>
                          </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-outline-primary" onclick="edit_shedule()">Apply Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /EDIT -->

<!-- /CREATE SHEDULE -->