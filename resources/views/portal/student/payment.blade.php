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

        <div class="card w-100">
          <div class="card-header">Payment Details</div>
          <div class="card-body">
            <form>
              <div class="card-title">
                <div class="col-12">
                  <div class="row">
                    {{-- PAYMENT TYPE --}}
                    <div class="col-md-4">Payment Type :</div>
                    <div class="col-md-8 mb-4">
                      <div class="form-row ml-1">
                        <div class="form-check mr-5">
                          <input type="radio" name="payment_type" class="form-check-input" value="registration"/>
                          <label class="form-check-label" for="FieldsetCheck">Year Registration</label>
                        </div>
                        <div class="form-check">
                          <input type="radio" name="payment_type" class="form-check-input" value="exam"/>
                          <label class="form-check-label" for="FieldsetCheck">Exam Application</label>
                        </div>
                      </div>
                    </div>
                    {{-- /PAYMENT TYPE --}}

                    {{-- REGISTRATION YEAR --}}
                    <div class="col-md-4">Registration Year :</div>
                    <div class="col-md-8 mb-4">2021</div>
                    {{-- /REGISTRATION YEAR --}}

                    {{-- EXAM --}}
                    <div class="col-md-4">Exam :</div>
                    <div class="col-md-8 mb-4">2020 December</div>
                    {{-- /EXAM --}}

                    {{-- SUBJECT --}}
                    <div class="col-md-4">Subjects :</div>
                    <div class="col-md-8 mb-3">
                      <div class="row">
                        {{-- 103 --}}
                        <div class="col-md-6"><span>FIT 103 : ICT Applications</span></div>
                        <div class="col-md-6 mb-3 mb-md-0">
                          <div class="form-row">
                            <div class="form-check mr-5">
                              <input type="checkbox" name="payment_type" class="form-check-input" value="registration"/>
                              <label class="form-check-label" for="FieldsetCheck">E-Test</label>
                            </div>
                            <div class="form-check">
                              <input type="checkbox" name="payment_type" class="form-check-input" value="exam"/>
                              <label class="form-check-label" for="FieldsetCheck">Practical</label>
                            </div>
                          </div>
                        </div>
                        {{-- 203 --}}
                        <div class="col-md-6"><span>FIT 203 : English for ICT</span></div>
                        <div class="col-md-6 mb-3 mb-md-0">
                          <div class="form-row">
                            <div class="form-check mr-5">
                              <input type="checkbox" name="payment_type" class="form-check-input" value="registration"/>
                              <label class="form-check-label" for="FieldsetCheck">E-Test</label>
                            </div>
                            <div class="form-check">
                              <input type="checkbox" name="payment_type" class="form-check-input" value="exam"/>
                              <label class="form-check-label" for="FieldsetCheck">Practical</label>
                            </div>
                          </div>
                        </div>
                        {{-- 303 --}}
                        <div class="col-md-6"><span>FIT 303 : Mathematics for ICT</span></div>
                        <div class="col-md-6 mb-3 mb-md-0">
                          <div class="form-row">
                            <div class="form-check mr-5">
                              <input type="checkbox" name="payment_type" class="form-check-input" value="registration"/>
                              <label class="form-check-label" for="FieldsetCheck">E-Test</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- /SUBJECT --}}                    
                  </div>
                </div>
              </div>
              <div class="card-text"></div>
            </form>
          </div>
        </div>

      </div>
    </div>
    <!-- /CONTENT -->




@endsection
