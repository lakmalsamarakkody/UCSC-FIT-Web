{{-- EXAM RESCHEDULE  --}}
<div class="modal fade" id="modal-view-reschedule-exam" data-bockdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewRescheduleModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dailog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRescheduleModal">Reschedule the Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 rescheduleExam">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-5">
                                <div class="card-header">Details</div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Student Name: </th>
                                            <td><span id="spaneStudentName"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Registration No: </th>
                                            <td><span id="spanStudentRegNo"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Subject: </th>
                                            <td><span id="spanRescheduleSubject"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Exam Type: </th>
                                            <td><span id="spanRescheduleExamType"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Earlier Exam Requested On: </th>
                                            <td><span id="spanEarlierExamRequested"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Medical Approved Date: </th>
                                            <td><span id="spanMedicalApprovedDate"></span><small class="text-muted"> (MM/DD/YY)</small></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">Schedules for Applied Exam</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12" id="divRescheduleSearch">
                                        </div>
                                        <div class="col-md-12 order-md-1 order-2 mt-5">
                                            <table class="table tbl-schedules-for-reschedule-exam">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Date</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Reschedule Later</button>
            </div>
        </div>
    </div>

</div>
{{-- /EXAM RESCHEDULE  --}}