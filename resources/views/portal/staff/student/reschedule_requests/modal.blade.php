<!-- VIEW RESCHEDULE REQUEST DETAILS -->
<div class="modal fade" id="modal-view-reschedule-request" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewExamApplication" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRescheduleRequest">Reschedule Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="card shadow-none">
                    <div class="card-body pb-0">                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-left">
                                    <tr>
                                        <th>Submitted on: </th>
                                        <td><span id="spanRequestedOn"></span> <small class="text-muted">(MM/DD/YY)</small></td>                                        
                                    </tr>
                                    <tr>
                                        <th>Student Name: </th>
                                        <td><span id="spanStudentName"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Registration Number: </th>
                                        <td><span id="spanRegNumber"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Reason to Reschedule: </th>
                                        <td><span id="spanReason"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- REQUESTED EXAMS TO RESCHEDULE --}}
                <div class="card shadow-none">
                    <div class="card-header pb-0">Exams requested to reschedule</div>
                    <div class="card-body pb-0 text-main-theme">                        
                        <div class="row">
                            <div class="col-lg-12">
                              <table class="table" id="requestedExamstbl">
                                <thead>
                                  <th>Subject code</th>
                                  <th>Subject</th>
                                  <th>Exam Type</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                </thead>
                                <tbody>

                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /REQUESTED EXAMS TO RESCHEDULE --}}
                
                {{-- APPROVED STATUS --}}
                <div class="card shadow-none">
                    <div class="card-header pb-0">Approval Status</div>
                    <div class="card-body pb-0 text-main-theme">                        
                        <div class="row">
                            <div class="col-lg-6">Payment : <i id="iconPaymentStatus" class="fas"></i> <span id="spanPaymentStatus"></span></div>
                        </div>
                    </div>
                </div>
                {{-- /APPROVED STATUS --}}

                <h6 class="card-header mt-4 mb-2">Reschedule Request Information</h6>

                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Payment</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Document</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" id="myTabContent">

                        <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-12 order-md-1 order-2">
                                                <input type="hidden" value="" id="paymentId" class="form-control"/>
                                                <table class="table text-left">
                                                    <tr>
                                                        <th>Date: </th>
                                                        <td><span id="spanPaymentDate"></span></td>                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank: </th>
                                                        <td><span id="spanPaymentBank"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch: </th>
                                                        <td><span id="spanPaymentBankBranch"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch Code: </th>
                                                        <td><span id="spanPaymentBankBranchCode"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Amount: </th>
                                                        <td>Rs.<span id="spanPaymentAmount"></span></td>
                                                    </tr>
                                                </table>
                                                <div id="imgExamPaymentBankSlip" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                              @if(Auth::user()->hasPermission('staff-dashboard-reschedule-request-payment-approve'))
                              <div id="divBtnApprovePayment" class="btn-group col-xl-3 mt-1">
                                  <button type="button" class="btn btn-success form-control" id="btnApprovePayment">Approve<span id="spinnerBtnApprovePayment" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                              </div>
                              @endif
                              @if(Auth::user()->hasPermission('staff-dashboard-reschedule-request-payment-decline'))
                              <div id="divBtnDeclinePayment" class="btn-group col-xl-3 mt-1">
                                  <button type="button" class="btn btn-warning form-control" id="btnDeclinePayment">Decline<span id="spinnerBtnDeclinePayment" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                              </div>
                              @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="col-lg-12 examInformation">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                Supporting Document for the request
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 order-md-1 order-2">


                                                        <div id="imgRecheduleReasonDocument" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCheckLater" data-dismiss="modal">Check Later</button>
            </div>
        </div>
    </div>

</div>
<!-- /VIEW RESCHEDULE REQUEST DETAILS -->