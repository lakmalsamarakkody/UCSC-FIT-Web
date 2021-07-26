{{-- EXAM DECLINED MESSAGE --}}
<div class="modal fade" id="modal-exam-declined-message" data-backdrop="static" tabindex="-1" aria-labelledby="modal-exam-declined-message-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 px-0">
                    <div class="alert alert-danger" role="alert">
                      <h4 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Reason to Decline</h4>
                      <p><span name="spanExamDeclinedMessage" id="spanExamDeclinedMessage"></span></p>
                    </div>
                </div>
                <div class="alert alert-info" role="alert">
                    <p class="font-weight-bold mb-0">If you want to re-apply for exams or get more details about the declined issue please contact <a href="mailto:{{ App\Models\Contact::where('type', 'coordinator')->first()->email }}">FIT Coordinator ({{ App\Models\Contact::where('type', 'coordinator')->first()->email }})</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- /EXAM DECLINED MESSAGE --}}


{{-- RESCHEDULE REQUEST --}}
<div class="modal fade" id="modal-exam-reschedule" data-backdrop="static" tabindex="-1" aria-labelledby="modal-exam-reschedule-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Request Exam Reschedule
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0 mx-4"> 

                <form id="requestRescheduleForm">

                    <label class="col-form-label">Select the schedules you want to request to reschedule</label>
                    <p>If you cannot see any schedules below, you cannot request a reschedule</p>

                    <div class="form-group ">
                    <input type="checkbox" id="selectAllSchedules"/>
                    <label class="col-form-label">Select All Available Schedules</label>
                    </div>

                    <table class="table table-hover ">

                        <tbody>
                            @foreach ($scheduled_exams as $exam)
                              @if($exam->schedule->date > date('Y-m-d'))
                                @if($exam->medical != null)
                                <tr>
                                    <td>Requested</td>
                                    <td class="text-center">FIT {{ $exam->subject->code }}</td>
                                    <td class="text-center">{{ $exam->subject->name }}</td>
                                    <td class="text-center">{{ $exam->type->name }}</td>
                                    <td class="text-center">{{ $exam->schedule->date }}</td>
                                    <td class="text-center">{{ $exam->schedule->start_time }} - {{ $exam->schedule->end_time }}</td>
                                </tr>                                
                                @elseif(\Carbon\Carbon::create($exam->schedule->date) >= \Carbon\Carbon::now()->addDays(2))
                                <tr>
                                    <td><div class="input-group"><input type="checkbox" class="selected-schedules" name="requestReschduleCheck[]" value="{{ $exam->id }}" /></div></td>
                                    <td class="text-center">FIT {{ $exam->subject->code }}</td>
                                    <td class="text-center">{{ $exam->subject->name }}</td>
                                    <td class="text-center">{{ $exam->type->name }}</td>
                                    <td class="text-center">{{ $exam->schedule->date }}</td>
                                    <td class="text-center">{{ $exam->schedule->start_time }} - {{ $exam->schedule->end_time }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td>Cannot Reschedule</td>
                                    <td class="text-center">FIT {{ $exam->subject->code }}</td>
                                    <td class="text-center">{{ $exam->subject->name }}</td>
                                    <td class="text-center">{{ $exam->type->name }}</td>
                                    <td class="text-center">{{ $exam->schedule->date }}</td>
                                    <td class="text-center">{{ $exam->schedule->start_time }} - {{ $exam->schedule->end_time }}</td>
                                </tr>
                                @endif
                              @endif
                            @endforeach
                        </tbody>

                    </table> 
                    <span class="invalid-feedback" id="requestReschduleCheck-err" role="alert"></span>

                    <hr>
                    <div class="form-group ">
                        <label for="rescheduleReason" class="col-form-label">Reason to Reschedule</label>
                            <textarea type="text" class="form-control" id="rescheduleReason" name="rescheduleReason"></textarea>

                            <span class="invalid-feedback" id="rescheduleReason-err" role="alert"></span>
                       
                    </div>
                    <div class="form-group">
                        <span id="InputMedicalHelp" class="form-text text-muted">Upload your scanned supporting document here in JPEG/ PNG file format. Maximum file size: 5mb</span>
                        <div class="drop-zone">
                            <span class="drop-zone__prompt">Scanned Supporting Document <br><small>Drop image File here or click to upload</small> </span>
                            <input type="file" name="supportDocument" id="supportDocument" class="drop-zone__input form-control"/>
                        </div>
                        <span class="invalid-feedback" id="supportDocument-err" role="alert"></span>
                    </div>

                    <h5 class="pt-3">Reschedule Payment (LKR) : 1500.00</h2>

                        <div class="text-center my-4">
                          <a class="btn btn-warning" target="_blank" href="{{ asset('documents/Payment_Voucher.pdf') }}">Download Payment Voucher</a>
                        </div>

                    {{-- PAYMENT ACTION --}}
                    <ul class="nav nav-tabs col-12" id="PaymentMethodTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="true">Pay Through Bank Slip</a>
                      </li>
                      {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">Pay Online</a>
                      </li> --}}
                    </ul>
  
                    <div class="tab-content col-12" id="PaymentMethodTabContent">
                      {{-- BANK PAYMENT --}}
                      <div class="tab-pane fade show active mt-4" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                        <form id="examPaymentForm">
                          <div class="form-row">                    
                            <div class="col-lg-12">
                              <div class="form-group row">
                                <label for="selectPaidBank" class="col-sm-3 col-form-label">Paid Bank</label>
                                <div class="col-sm-9">
                                  <select class="form-control" id="paidBank" name="paidBank">
                                    <option value="" disabled>Select Bank</option>
                                      @foreach ($banks as $bank)
                                        <option selected  value="{{$bank->id}}">{{$bank->name}}</option>
                                      @endforeach
                                  </select>
                                  <span class="invalid-feedback" id="paidBank-err" role="alert"></span>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputPaidBankBranch" class="col-sm-3 col-form-label">Paid Branch Branch</label>
                                <div class="col-sm-9">
                                  <select class="form-control" id="paidBankBranch" name="paidBankBranch">
                                    <option value="" selected disabled>Select Bank Branch</option>
                                      @foreach ($banks->where('name', 'Peoples Bank')->first()->branch()->orderBy('name')->get() as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                      @endforeach
                                  </select>
                                  <span class="invalid-feedback" id="paidBankBranch-err" role="alert"></span>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputPaidDate" class="col-sm-3 col-form-label">Paid Date</label>
                                <div class="col-sm-9">
                                  <input type="date" class="form-control" id="paidDate" name="paidDate" >
                                  <span class="invalid-feedback" id="paidDate-err" role="alert"></span>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputPaidAmount" class="col-sm-3 col-form-label">Paid Amount</label>
                                <div class="col-sm-9">
                                  <input readonly type="number" class="form-control" id="paidAmount" name="paidAmount" value="1500.00" >
                                  <span class="invalid-feedback" id="paidAmount-err" role="alert"></span>
                                </div>
                              </div>  
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group mx-2">
                                <span id="InputBankslipHelp" class="form-text text-muted">Upload your scanned bank slip here in JPEG/ PNG file format. Maximum file size: 5mb</span>
                                <div class="drop-zone">
                                  <span class="drop-zone__prompt">Scanned Bank Slip <br><small>Drop image File here or click to upload</small> </span>
                                  <input type="file" name="bankSlip" id="bankSlip" class="drop-zone__input form-control"/>
                                </div>
                                <span class="invalid-feedback" id="bankSlip-err" role="alert"></span>
                              </div>
                            </div>
                          </div>
  
                        </form>
                      </div>
                      {{-- /BANK PAYMENT --}}
  
                      {{-- ONLINE PAYMENT --}}
                      <div class="tab-pane fade mt-4" id="online" role="tabpanel" aria-labelledby="online-tab">
                        <div class="alert alert-info" role="alert">
                          You will be redirected to bank online payment gateway!
                        </div>
                        <button type="button" class="btn btn-outline-primary">Pay Online</button>
                      </div>
                      {{-- ONLINE PAYMENT --}}
                    </div>
                    {{-- /PAYMENT ACTION --}}
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="location.reload()">Discard</button>
                <button id="btnrequestReschdule" onclick="submit_reschedule_request()" type="button" class="btn btn-outline-primary">
                  Request Reschedule
                  <span id="requestReschduleSpinner" class="spinner-border spinner-border-sm mb-2 d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>
{{-- /RESCHEDULE REQUEST --}}