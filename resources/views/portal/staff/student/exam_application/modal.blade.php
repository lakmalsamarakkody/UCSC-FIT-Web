<!-- VIEW EXAM APPLICATION DETAILS -->
<div class="modal fade" id="modal-view-exam-application" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewExamApplication" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewExamApplication">Exam Application</h5>
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
                                        <td><span id="spanSubmittedOn"></span> <small class="text-muted">(MM/DD/YY)</small></td>                                        
                                    </tr>
                                    <tr>
                                        <th>Type: </th>
                                        <td>Exam</td>
                                    </tr>
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

                <h6 class="card-header mt-4 mb-2">Applied Exams Information</h6>

                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="col-lg-12 examInformation">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                Applied Exams
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 order-md-1 order-2">
                                                        <table class="tbl-applied-exams table table-responsive-md">
                                                            <thead>
                                                                <tr>
                                                                    <th>Subject Code</th>
                                                                    <th>Subject Name</th>
                                                                    <th>Exam Type</th>
                                                                    <th>Requested Exam</th>
                                                                    <th>Scheduled Date</th>
                                                                    <th>Scheduled Time</th>
                                                                    <th>&nbsp;</th>
                                                                </tr>
                                                            </thead>
                                                            {{-- <tbody> --}}
                                                                {{-- @foreach ($student_applied_exams as $exam) --}}
                                                                {{-- <tr>
                                                                    <td><span id="spanSubjectCode"></span></td>
                                                                    <td><span id="spabSubjectName"></span></td>
                                                                    <td><span id="spanExamType"></span></td>
                                                                    <td><span id="spanRequestedExan"></span></td>
                                                                    <td><span id="spanScheduledDate"></span></td> --}}
                                                                    {{-- <td>{{ \Carbon\Carbon::createFromDate($exam->exam->year, $exam->exam->month)->monthName }} {{ $exam->exam->year }}</td> 
                                                                    <td>@if($exam->exam_schedule_id == null)Not yet scheduled @else {{ $exam->schedule->date }}@endif</td> --}}
                                                                    {{-- <td>
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-outline-primary" id="btnScheduleAppliedExam-" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Schedule Exam"><i class="fas fa-calendar-alt"></i></button>
                                                                            <button type="button" class="btn btn-outline-warning" id="btnDeclineAppliedExam-" data-tooltip="tooltip" data-toggle="modal" data-placement="bottom" title="Decline Exam"><i class="fas fa-times-circle"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr> --}}
                                                                {{-- @endforeach --}}
                                                            {{-- </tbody> --}}
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                @if(Auth::user()->hasPermission('staff-dashboard-exam-application-approveSchedules'))
                                <div id="divBtnAssignAppliedExams" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-success form-control" id="btnAssignScheduledExams" onclick="assign_scheduled_exams();">Approve Schedules<span id="spinnerBtnAssignScheduledExams" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                                @endif
                                {{-- <div id="divBtnDeclineAppliedExams" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-exams-message" id="btnDeclineAppliedExams" data-toggle="modal">Decline Applied Exams<span id="spinnerBtnDeclineAppliedExam" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div> --}}
                            </div>
                        </div>

                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
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
                                                <div class="col-lg m-1">
                                                    <div id="imgExamPaymentBankSlip" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                                </div>
                                                <div class="col-lg m-1">
                                                    <div id="imgExamPaymentBankSlip2" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                @if(Auth::user()->hasPermission('staff-dashboard-exam-application-payment-approve'))
                                <div id="divBtnApprovePayment" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApproveExamPayment" onclick="approve_exam_payment();">Approve Payment<span id="spinnerBtnApproveExamPayment" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                                @endif
                                @if(Auth::user()->hasPermission('staff-dashboard-exam-application-payment-decline'))
                                <div id="divBtnDeclinePayment" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-warning form-control" id="btnDeclineExamPayment" onclick="decline_exam_payment();">Decline Payment<span id="spinnerBtnDeclineExamPayment" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                                @endif
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
<!-- /VIEW EXAM APPLICATION DETAILS -->

<!-- SCHEDULE APPLIED EXAM-->
<div class="modal fade" id="modal-schedule-applied-exam" data-backdrop="static" tabindex="-1" aria-labelledby="modal-schedule-applied-exam-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule the Exam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 scheduleExam">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-5">
                                <div class="card-header">Applied Exam Details</div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Subject: </th>
                                            <td><span id="spanAppliedSubject"></span></td>
                                        </tr>
                                            <th>Exam Type: </th>
                                            <td><span id="spanAppliedExamType"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Requested Exam On: </th>
                                            <td><span id="spanRequestedExam"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">Available Sessions for Applied Exam</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div id="divSearchSchedules" class="col-12">
                                            {{-- <div class="row">
                                                <div class="form-group col-xl-6 col-12">
                                                    <select name="searchExam" id="searchExam" class="form-control">
                                                    <option value="" selected hidden>Select Exam</option>
                                                    @foreach ($exams as $exam)
                                                        <option value="{{$exam->id}}">{{ \Carbon\Carbon::createFromDate($exam->year,$exam->month)->monthName}} {{$exam->year}} </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-xl-6 col-12">
                                                    <button type="button" class="btn btn-outline-primary form-control" onclick="search_schedules_by_exam();" id="btnSearchByExam"><i class="fa fa-search"></i>Search<span id="spinnerBtnSearchByExam" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- id="tblSchedulesForAppliedExam" --}}
                                        <div class="col-md-12 order-md-1 order-2 mt-2">
                                            <table class="table tbl-schedules-for-applied-exam">
                                                <thead>
                                                    <tr>
                                                        <th>Total Assigned</th>
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
                {{-- <form id="formScheduleAppliedExam">
                    <div class="form-row align-items-center">
                        <div class="form-group col-6">
                            <label for="scheduleExamDate">Date</label>
                            <input type="hidden" class="form-control" id="scheduleExamId" name="scheduleExamId" />
                            <span class="invalid-feedback" id="error-scheduleExamId" role="alert"></span>
                            <select name="scheduleExamDate" id="scheduleExamDate" class="form-control">
                                <option value="" hidden selected>Please Select a Exam Date</option>
                            </select>
                            <span class="invalid-feedback" id="error-scheduleExamDate" role="alert"></span>
                        </div>
                        <div class="form-group col-3">
                            <label for="scheduleExamStartTime">Start Time</label>
                            <div><span id="spanStartTime">10:00PM</span></div>
                        </div>
                        <div class="form-group col-3">
                            <label for="scheduleExamEndTime">End Time</label>
                            <div><span id="spanEndTime">12:00 PM</span></div>
                        </div>

                    </div>
                </form> --}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Schedule Later</button>
            </div>
        </div>
    </div>
</div>
<!-- /SCHEDULE APPLIED EXAM-->