@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
      $('#registration').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 payment min-vh-100">

      {{-- PAYMENT CHECK --}}
      @if($payment != NULL && $registration->payment_status != 'Declined') 
        {{-- PAYMENT NOT REVIEWD --}}

        {{-- PAYMENT APPROVAL PENDING --}}
        <div class="col-12 px-0">
          <div class="alert alert-info" role="alert">
            <h4 class="alert-heading"><i class="far fa-check-circle"></i> Payment Submitted Successfully</h4>
            <p>Come back later to check whether your payment has beend approved. If your payment didn't get approved within 2 weeks please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
            <hr>
            <p class="font-weight-bold mb-0">Prepare Your Scanned Birth Certificate and Unique Identification images (NIC / Passport / Postal ID) </p>
          </div>
        </div>
        {{-- /PAYMENT APPROVAL PENDING --}}
      
      {{-- NO PAYMENT DONE OR PAYMENT DECLINED --}}
      @else

        {{-- PAYMENT DECLINED CHECK --}}
        @if($payment != NULL && $registration->payment_status == 'Declined') 
          {{-- PAYMENT APPROVAL DECLINED --}}
          <div class="col-12 px-0">
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Payment Declined!</h4>
              <p>{{ $registration->declined_msg }}</p>
              <hr>
              <p class="font-weight-bold mb-0">Please upload correct payment details</p>
              <p class="font-weight-bold mb-0">If you think this was mistaken attach your payment slip and send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
              </div>
          </div>
          {{-- /PAYMENT APPROVAL DECLINED --}}
        @endif
        {{-- /PAYMENT DECLINED CHECK --}}
      

        <form id="registerPaymentForm">      
          <div class="row row-cols-1 row-cols-md-2">
            {{-- PAYMENT DETAILS --}}
            <div class="col mb-3">
              <div class="card w-100 h-100" >
                <div class="card-header">Payment Details</div>
                <div class="card-body">
                  <div class="col-12">
                    <div class="row">
                      {{-- PAYMENT TYPE --}}
                      <div class="col-md-4">Payment Type :</div>
                      <div class="col-md-8">Year Registration</div>
                      {{-- /PAYMENT TYPE --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- /PAYMENT DETAILS --}}

            {{-- SUBJECT DETAILS --}}
              <div class="col mb-3">        
                <div class="card w-100 h-100" >
                  <div class="card-header">Registration Details</div>
                  <div class="card-body">

                    <div class="col-12">
                      <div class="row">
                        <div class="col-md-4">Registration Expires On:</div>
                        <div class="col-md-8" >{{now()->isoFormat('MMMM Do')}} {{ now()->year+1 }}</div>
                      </div>
    
                    </div>

                  </div>
                </div>
              </div>
            {{-- /SUBJECT DETAILS --}}
          </div>
          <div class="row row-cols-1">
            {{-- PAYMENT --}}
            <div class="col">
              <div class="card w-100 my-2">
                <div class="card-header">
                  <div class="text-left">TOTAL PAYMENT : {{ $reg_fee}}/=</div>
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
                          <a class="nav-link active" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="true">Pay Through Bank Slip</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="online-tab" data-toggle="tab" href="#online" role="tab" aria-controls="online" aria-selected="false">Pay Online</a>
                        </li>
                      </ul>

                      <div class="tab-content col-12" id="PaymentMethodTabContent">
                        {{-- BANK PAYMENT --}}
                        <div class="tab-pane fade show active mt-4" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                          <form enctype="multipart/form-data">
                            <div class="form-row">                    
                              <div class="col-lg-12">
                                <div class="form-group row">
                                  <label for="selectPaidBank" class="col-sm-3 col-form-label">Paid Bank</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" id="paidBank" name="paidBank">
                                      <option value="" selected disabled>Select Bank</option>
                                      @if($banks != NULL)
                                        @foreach ($banks as $bank)
                                          @if($bank->name == 'Peoples Bank')
                                            <option value="{{$bank->id}}" selected>{{$bank->name}}</option>
                                          @else
                                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                                          @endif;
                                        @endforeach
                                      @else
                                        <option value="" disabled>No Banks Found</option>
                                      @endif
                                    </select>
                                    <span class="invalid-feedback" id="error-paidBank" role="alert"></span>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputPaidBankBranch" class="col-sm-3 col-form-label">Paid Branch Branch</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" id="paidBankBranch" name="paidBankBranch">
                                      <option value="" selected disabled>Select Bank Branch</option>
                                      @if($banks != NULL)
                                        @foreach ($banks->where('name', 'Peoples Bank')->first()->branch()->orderBy('name')->get() as $branch)
                                          @if($payment != NULL && $payment->bank_branch_id == $branch->id)
                                            <option value="{{$branch->id}}" selected>{{$branch->name}}</option>
                                          @else
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                          @endif
                                        @endforeach
                                      @else
                                        <option value="" disabled>No Branches Found</option>
                                      @endif
                                    </select>
                                    <span class="invalid-feedback" id="error-paidBankBranch" role="alert"></span>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputPaidDate" class="col-sm-3 col-form-label">Paid Date</label>
                                  <div class="col-sm-9">
                                    <input type="date" class="form-control" id="paidDate" name="paidDate" @if($payment != NULL) value="{{$payment->paid_date}}" @endif>
                                    <span class="invalid-feedback" id="error-paidDate" role="alert"></span>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="inputPaidAmount" class="col-sm-3 col-form-label">Paid Amount</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" id="paidAmount" name="paidAmount" @if($payment != NULL) value="{{$payment->amount}}" @endif>
                                    <span class="invalid-feedback" id="error-paidAmount" role="alert"></span>
                                  </div>
                                </div>  
                              </div>
                              <div class="col-lg-12">
                                <div class="form-group mx-2">
                                  @if($payment != NULL)
                                    <small id="InputUploadedBankslipHelp" class="form-text text-muted">Uploaded scanned bank slip</small>
                                    <div class="drop-zone" style="background: url({{ asset('storage/payments/registration/'.$student->id.'/'.$payment->image)}}) no-repeat center; background-size: cover;"></div>
                                    <small id="InputBankslipHelp" class="form-text text-muted">Upload your scanned bank slip here in JPEG/ PNG file format</small>
                                    <div class="drop-zone">
                                      <span class="drop-zone__prompt">Reupload Bank Slip <br><small>Drop image File here or click to upload</small> </span>
                                      <input type="file" name="bankSlip" id="bankSlip" class="drop-zone__input form-control"/>
                                    </div>
                                  @else
                                  <small id="InputBankslipHelp" class="form-text text-muted">Upload your scanned bank slip here in JPEG/ PNG file format</small>
                                    <div class="drop-zone">
                                      <span class="drop-zone__prompt">Scanned Bank Slip <br><small>Drop image File here or click to upload</small> </span>
                                      <input type="file" name="bankSlip" id="bankSlip" class="drop-zone__input form-control"/>
                                    </div>
                                  @endif
                                  <span class="invalid-feedback" id="error-bankSlip" role="alert"></span>
                                </div>
                              </div>
                            </div>

                            <div class="form-row justify-content-end">

                              <div class="mt-3 col-xl-2 col-md-6 order-sm-1 order-3" id="divResetForm">
                                  <button type="button" class="btn btn-secondary form-control" id="btnResetForm" onclick="reset_form()">Discard</button>
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
        </form>
      @endif
      {{-- /PAYMENT CHECK --}}

    </div>
    <!-- /CONTENT -->

    @include('portal.student.payment.registration.scripts')


@endsection
