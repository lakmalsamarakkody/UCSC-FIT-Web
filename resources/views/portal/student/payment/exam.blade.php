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
        
        <h5 class="alert-heading text-right">Registration expires on: {{ Auth::user()->student->current_registration->registration_expire_at }}</h5>                
        
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
                <div class="row">
                  @foreach ($exam_details as $exam)
                    <div class="col-lg-3 col-6 div-title">Subject Code:</div>
                    <div class="col-lg-3 col-6">FIT {{ $exam->subject->code }}</div>
  
                    <div class="col-lg-3 col-6 div-title">Subject Name:</div>
                    <div class="col-lg-3 col-6">{{ $exam->subject->name }}</div>
  
                    <div class="col-lg-3 col-6 div-title">Exam Type:</div>
                    <div class="col-lg-3 col-6">{{ $exam->type->name }}</div>
  
                    <div class="col-lg-3 col-6 div-title">Exam Fee:</div>
                    <div class="col-lg-3 col-6">{{ \App\Models\Support\Fee::select('amount')->where('subject_id', $exam->subject->id)->where('exam_type_id', $exam->type->id)->first()->amount }}</div>
  
                    <hr width="100%"/>
                  @endforeach

                  <div class="col-12 text-center" id="div-total-fees">
                    <b>Sum of Exam fees to pay:</b> {{ $total_amount }}LKR
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- PAYMENT DETAILS --}}


      <div class="row row-cols-1">
         {{-- PAYMENT --}}
        <div class="col">
          <div class="card w-100 my-2">
            <div class="card-header">Total Payment : 2800/=</div>
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
                      <form>
                        <div class="form-row">                    
                          <div class="col-lg-6">
                            <div class="form-group row">
                              <label for="selectPaidBank" class="col-sm-3 col-form-label">Paid Bank Branch</label>
                              <div class="col-sm-9">
                                <select class="form-control" id="selectPaidBank">
                                  <option>Colombo 04</option>
                                  <option>Gampaha</option>
                                  <option>Kandy</option>
                                  <option>Galle</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPaidBankCode" class="col-sm-3 col-form-label">Paid Branch Code</label>
                              <div class="col-sm-9">
                                <input type="number" class="form-control" id="inputPaidBankCode">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPaidDate" class="col-sm-3 col-form-label">Paid Date</label>
                              <div class="col-sm-9">
                                <input type="date" class="form-control" id="inputPaidDate">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPaidAmount" class="col-sm-3 col-form-label">Paid Amount</label>
                              <div class="col-sm-9">
                                <input type="number" class="form-control" id="inputPaidAmount">
                              </div>
                            </div>  
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mx-2">
                              <small id="InputStudentNameHelp" class="form-text text-muted">Upload your scanned bank slip here in JPEG/ PNG file format</small>
                              <div class="drop-zone">
                                <span class="drop-zone__prompt">Scanned Bank Slip <br><small>Drop image File here or click to upload</small> </span>
                                <input type="file" name="resultFile" id="resultFile" class="drop-zone__input"/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="form-row justify-content-end">
  
                          <div class="mt-3 col-xl-2 col-md-6 order-sm-1 order-3" id="divResetForm">
                              <button type="button" class="btn btn-secondary form-control" id="btnResetForm" onclick="reset_form()">Discard</button>
                          </div>
                          <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveInformation">
                              <button type="button" class="btn btn-outline-primary form-control" id="btnSaveInformation" role="button" aria-expanded="false" aria-controls="declaration" onclick="save_informatioin()">Submit Payment</button>
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




@endsection
