@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
      $('#results').addClass("active");
    });

</script>

    <!-- CONTENT -->
    <div class="col-lg-12 payment min-vh-100">
      <div class="row">

        {{-- PAYMENT DETAILS --}}
        <div class="card w-100 my-4">
          <div class="card-header">Payment Details</div>
          <div class="card-body">
            <div class="col-12">
              <div class="row">

                {{-- PAYMENT TYPE --}}
                <div class="col-md-4">Payment Type :</div>
                <div class="col-md-8">
                  <div class="form-check mr-5">
                    <input type="radio" name="payment_type" class="form-check-input" value="registration"/>
                    <label class="form-check-label" for="FieldsetCheck">Year Registration</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="payment_type" class="form-check-input" value="exam"/>
                    <label class="form-check-label" for="FieldsetCheck">Exam Application</label>
                  </div>
                </div>
                {{-- /PAYMENT TYPE --}}

                <hr width="100%"/>

                {{-- REGISTRATION YEAR --}}
                <div class="col-md-4">Registration Year :</div>
                <div class="col-md-8">2021</div>
                {{-- /REGISTRATION YEAR --}}

                <hr width="100%"/>

                {{-- EXAM --}}
                <div class="col-md-4">Exam :</div>
                <div class="col-md-8">2020 December</div>
                {{-- /EXAM --}}

              </div>
            </div>
          </div>
        </div>
         {{-- /PAYMENT DETAILS --}}

         {{-- SUBJECT DETAILS --}}
        <div class="card w-100">
          <div class="card-header">Subject Details</div>
          <div class="card-body">

            <div class="col-12">
              <div class="row">
                {{-- SUBJECTS --}}
                {{-- 103 --}}
                <div class="col-sm-6 col-lg-4"><span>FIT 103 : ICT Applications</span></div>
                <div class="col-sm-6 col-lg-8">
                  <div class="form-check mr-5">
                    <input type="checkbox" name="payment_type" class="form-check-input" value="registration"/>
                    <label class="form-check-label" for="FieldsetCheck">E-Test</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" name="payment_type" class="form-check-input" value="exam"/>
                    <label class="form-check-label" for="FieldsetCheck">Practical</label>
                  </div>
                </div>
                {{-- /103 --}}
                <hr width="100%"/>
                {{-- 203 --}}
                <div class="col-sm-6 col-lg-4"><span>FIT 203 : English for ICT</span></div>
                <div class="col-sm-6 col-lg-8">
                  <div class="form-check mr-5">
                    <input type="checkbox" name="payment_type" class="form-check-input" value="registration"/>
                    <label class="form-check-label" for="FieldsetCheck">E-Test</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" name="payment_type" class="form-check-input" value="exam"/>
                    <label class="form-check-label" for="FieldsetCheck">Practical</label>
                  </div>
                </div>
                {{-- /203 --}}
                <hr width="100%"/>
                {{-- 303 --}}
                <div class="col-sm-6 col-lg-4"><span>FIT 303 : Mathematics for ICT</span></div>
                <div class="col-sm-6 col-lg-8">
                  <div class="form-check mr-5">
                    <input type="checkbox" name="payment_type" class="form-check-input" value="registration"/>
                    <label class="form-check-label" for="FieldsetCheck">E-Test</label>
                  </div>
                </div>
                {{-- /303 --}}
                {{-- /SUBJECT --}}    
              </div>
            </div>

          </div>
        </div>
         {{-- /SUBJECT DETAILS --}}

         {{-- PAYMENT --}}
        <div class="card w-100 my-4">
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
                      <div class="form-group row">
                        <label for="selectPaidBank" class="col-sm-2 col-form-label">Paid Bank Branch</label>
                        <div class="col-sm-10 col-lg-4">
                          <select class="form-control" id="selectPaidBank">
                            <option>Colombo 04</option>
                            <option>Gampaha</option>
                            <option>Kandy</option>
                            <option>Galle</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPaidBankCode" class="col-sm-2 col-form-label">Paid Bank Code</label>
                        <div class="col-sm-10 col-lg-4">
                          <input type="number" class="form-control" id="inputPaidBankCode">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPaidDate" class="col-sm-2 col-form-label">Paid Date</label>
                        <div class="col-sm-10 col-lg-4">
                          <input type="date" class="form-control" id="inputPaidDate">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPaidAmount" class="col-sm-2 col-form-label">Paid Amount</label>
                        <div class="col-sm-10 col-lg-4">
                          <input type="number" class="form-control" id="inputPaidAmount">
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
         {{-- /PAYMENT --}}

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
