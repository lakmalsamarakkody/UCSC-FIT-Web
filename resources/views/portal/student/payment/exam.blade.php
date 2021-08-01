@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
      $('#exams').addClass("active");
    });

</script>
    <div class="col-6">
        <h4 class="alert-heading">Payment: Exam</h4>
        

    </div>
    <div class="col-6">
        <h4 class="alert-heading text-right">Registration Number: {{ Auth::user()->student->reg_no }}</h4>
        
        <h5 class="alert-heading text-right">Registration expires on: {{ Auth::user()->student->current_active_registration()->registration_expire_at }}</h5>                
        
    </div>
    <!-- CONTENT -->
    <div class="col-lg-12 payment min-vh-100">
      {{-- PAYMENT DETAILS --}}
      <div class="row row-cols-1">
        <div class="col mb-3">
          <div class="card w-100 h-100">
            <div class="card-header">Exam fees for Applied Subjects</div>
            <div  class="card-body">
              <div class="col-12">
                <table class="table text-center">
                  <thead>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Exam Type</th>
                    <th>Exam Fee (LKR)</th>
                  </thead>
                  <tbody>
                    @foreach ($selected_exams as $selected_exam)
                    <tr>
                      <td>FIT {{ $selected_exam->subject->code }}</td>
                      <td>{{ $selected_exam->subject->name }}</td>
                      <td>{{ $selected_exam->type->name }}</td>
                      <td>{{ \App\Models\Support\Fee::select('amount')->where('subject_id', $selected_exam->subject->id)->where('exam_type_id', $selected_exam->type->id)->first()->amount }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="3" class=" text-right"><b>Sum of Exam fees to pay:</b></th>
                      <th><b>{{ $total_amount }}</b></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="card-footer text-left pt-0 ml-2">
              <a class="btn btn-danger" href="{{ route('student.exam') }}"><i class="fa fa-arrow-left"></i> change subjects</a>
              
            </div>
          </div>
        </div>
      </div>
      {{-- PAYMENT DETAILS --}}


      <div class="row row-cols-1">
         {{-- PAYMENT --}}
        <div class="col">
          <div class="card w-100 my-2">
            <div class="card-header">
              <div class="text-left">Total Payment (LKR) : {{ $total_amount }}</div>
              <div class="text-right">
                <a class="btn btn-warning" target="_blank" href="{{ asset('documents/Payment_Voucher.pdf') }}">Download Payment Voucher</a>
              </div>
            </div>
            <div class="card-body">
              <div class="col-12">
                <div class="row">

                  {{-- PAYMENT ACTION --}}
                  <ul class="nav nav-tabs col-12" id="PaymentMethodTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="true">Pay Through Payment Voucher</a>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                      <a class="nav-link" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">Pay Online</a>
                    </li> --}}
                  </ul>

                  <div class="tab-content col-12" id="PaymentMethodTabContent">
                    {{-- BANK PAYMENT --}}
                    <div class="tab-pane fade show active mt-4" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                      <ul>
                        <li>Download and Print the Payment Voucher</li>
                        <li>Pay the examination fee ({{ $total_amount }}) to the bank with the payment voucher (The bank will sign and certify the EDC Copy-1 and Candidate's Copy-2 of the payment voucher)</li>
                        <li>Scan your certified EDC Copy-1 <strong>(with the bank seal)</strong> of the payment voucher and the bank slip.</li>
                        <li>Upload your scanned EDC copy-1 and the Bank slip.</li>
                      </ul>                      
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
                                <span class="invalid-feedback" id="error-paidBank" role="alert"></span>
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
                                <span class="invalid-feedback" id="error-paidBankBranch" role="alert"></span>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPaidDate" class="col-sm-3 col-form-label">Paid Date</label>
                              <div class="col-sm-9">
                                <input type="date" class="form-control" id="paidDate" name="paidDate" >
                                <span class="invalid-feedback" id="error-paidDate" role="alert"></span>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPaidAmount" class="col-sm-3 col-form-label">Paid Amount</label>
                              <div class="col-sm-9">
                                <input readonly type="number" class="form-control" id="paidAmount" name="paidAmount" value="{{ $total_amount }}" >
                                <span class="invalid-feedback" id="error-paidAmount" role="alert"></span>
                              </div>
                            </div>  
                          </div>
                          <div class="col-lg-12">
                            {{-- UPLOAD PAYMENT SLIP --}}
                            <div class="form-group mx-2">
                              <span id="InputBankslipHelp" class="form-text text-muted">Upload your scanned payment voucher EDC copy-1 here in JPEG/ PNG file format. Maximum file size: 5MB</span>
                              <div class="drop-zone">
                                <span class="drop-zone__prompt">Scanned Payment Voucher EDC copy-1 <br><small>Drop image File here or click to upload</small> </span>
                                <input type="file" name="bankSlip" id="bankSlip" class="drop-zone__input form-control"/>
                              </div>
                              <span class="invalid-feedback" id="error-bankSlip" role="alert"></span>
                            </div>
                            {{-- UPLOAD PAYMENT SLIP --}}

                            {{-- UPLOAD PAYMENT SLIP 2 --}}
                            <div class="form-group mx-2">
                                <span id="InputBankslip2Help" class="form-text text-muted">Upload your scanned bank slip here in JPEG/ PNG file format. Maximum file size: 5MB</span>
                                <div class="drop-zone">
                                  <span class="drop-zone__prompt">Scanned Bank Slip <br><small>Drop image File here or click to upload</small> </span>
                                  <input type="file" name="bankSlip2" id="bankSlip2" class="drop-zone__input form-control"/>
                                </div>
                              <span class="invalid-feedback" id="error-bankSlip2" role="alert"></span>
                            </div>
                            {{-- UPLOAD PAYMENT SLIP 2 --}}


                          </div>
                        </div>

                        <div class="form-row justify-content-end">

                          <div class="mt-3 col-xl-2 col-md-6 order-sm-1 order-3" id="divResetForm">
                              <button type="button" class="btn btn-secondary form-control" id="btnResetForm" onclick="window.location.reload();">Discard</button>
                          </div>
                          <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveInformation">
                              <button type="button" class="btn btn-outline-primary form-control" id="btnSavePayment" role="button" aria-expanded="false" aria-controls="declaration" onclick="save_payment()">
                                Submit Payment
                                <span id="spinner" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                              </button>
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

                </div>
              </div>
            </div>
          </div>
        </div>

         {{-- /PAYMENT --}}

      </div>
    </div>
    <!-- /CONTENT -->


    @include('portal.student.payment.exam.scripts')


@endsection
