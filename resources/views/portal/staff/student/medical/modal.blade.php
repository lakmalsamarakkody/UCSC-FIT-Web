<!-- MEDICAL REVIEW -->
<div class="modal fade" id="modal-medical" data-backdrop="static" tabindex="-1" aria-labelledby="modal-medical-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Medical Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 medicalDetails">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">Student Details</div>
                                <div class="card-body pb-0">                        
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <table class="table text-left">
                                                <tr>
                                                    <th>Student Name: </th>
                                                    <td><span id="spanStudentName"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>Registration Number: </th>
                                                    <td><span id="spanRegNumber"></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <div class="card-header pb-0">Medical</div>
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-md-12 order-md-1 order-2 mt-4">
                                            <table id="tblMedicals" class="table">
                                                <tr>
                                                    <th>Submitted on: </th>
                                                    <td><span id="spanSubmittedOn"></span> <small class="text-muted">(MM/DD/YY)</small></td>                                        
                                                </tr>
                                                <tr>
                                                    <th>Subject Code: </th>
                                                    <td><span id="spanSubjectCode"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>Subject Name: </th>
                                                    <td><span id="spanSubjectName"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>Exam Type: </th>
                                                    <td><span id="spanExamType"></span></td>
                                                </tr>
                                                <tr>
                                                    <th>Exam Held Date: </th>
                                                    <td><span id="spanExamHeldDate"></span> <small class="text-muted">(MM/DD/YY)</small></td>
                                                </tr>
                                                <tr>
                                                    <th>Reason: </th>
                                                    <td><span id="spanMedicalReason"></span></td>                                        
                                                </tr>
                                            </table>
                                            <div class="col-lg-12">
                                                <div name="imgMedical" id="imgMedical" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                            <div class="mt-4 col-12 text-center mb-4">
                                                <div id="divBtnApproveMedical" class="btn-group col-xl-3 col-lg-6">
                                                    <button type="button" class="btn btn-success form-control" id="btnApproveMedical">Approve Medical<span id="spinnerBtnApproveMedical" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                                </div>
                                                <div id="divBtnDeclineMedical" class="btn-group col-xl-3 col-lg-6">
                                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-medical-message" id="btnDeclineMedical" data-toggle="modal">Decline Medical<span id="spinnerBtnDeclineMedical" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Check Later</button>
            </div>
        </div>
    </div>
</div>
<!-- /MEDICAL REVIEW-->