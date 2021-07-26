@extends('layouts.student_portal')

@section('content')

<script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#registration').addClass("active");
    });

</script>
    <!-- CONTENT -->
    <div class="col-lg-12 student-exams min-vh-100">
      <div class="row">

        @if ($registration->document_submit == 0 && $registration->document_status == NULL)
          {{-- PAYMENT APPROVED --}}
          <div class="col-12 px-0">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Payment Approved</h4>
              <p>Your payment has been approved.</p>
              <hr>
              <p class="font-weight-bold mb-0">Please upload clear images of both the sides of the birth certificate and the {{$document_type}}. All your details must be clearly visible in the images.</p>
            </div>
          </div>
          {{-- /PAYMENT APPROVED --}}
        @endif


        {{-- DOCUMENT SUBMIT CHECK --}}
        @if($registration->document_submit == 1 && $registration->document_status != 'Declined')

          {{-- DOCUMENT APPROVAL PENDING --}}
          <div class="col-12 px-0">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading"><i class="fas fa-check-circle"></i> Documents Submitted Successfully</h4>
              <p>Your registration will complete only after the documents have been approved.</p>
              <hr>
              <p class="font-weight-bold mb-0">If your registration has not been approved within  two weeks time, please email the FIT Coordinator <a href="mailto:{{ App\Models\Contact::where('type', 'coordinator')->first()->email }}">FIT Co-ordinator ({{ App\Models\Contact::where('type', 'coordinator')->first()->email }})</a> stating your concerns.</p>
            </div>
          </div>
          {{-- /DOCUMENT APPROVAL PENDING --}}

          {{-- SUBMIT HARD COPIES --}}
          {{-- <div class="col-12 px-0">
            <div class="alert alert-danger" role="alert">
              <h3 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> POST THE FOLLOWING DOCUMENTS THROUGH REGISTERED-POST </h3>
              <p>Make sure to post your </p>
                <p><i>
                Application - <button type="button" class="btn btn-sm btn-outline-danger" onclick="window.location.href='/portal/student/information'"> Download Application </button><br/>
                Payment slip - Payment voucher (EDC copy -1) <br/>
                Documents -  Copies of your birth certificate, a copy of your {{$document_type}} which was previously uploaded<br/>
                </i></p>
              <p>
              Please note that it is mandatory to send the said documents to the address given below, in order to successfully complete your registration process.</p>
              <hr>
              <span>Address:</span>
              <p class="font-weight-bold mb-0">
                Senior Assistant Registrar (EDC),<br/>
                External Degrees Centre of UCSC,<br/>
                University of Colombo School of Computing,<br/>
                No. 35, Reid Avenue,<br/>
                Colombo 07,<br/>
                Sri Lanka.
              </p>
            </div>
          </div> --}}
          {{-- /SUBMIT HARD COPIES --}}
        
        {{-- DOCUMENTS NOT SUBMITTED --}}
        @else

          {{-- IF ALL COMPLETE SHOW SUBMIT DOCUMENTS BUTTON --}}
          @if($student->document()->where('type', 'birth')->first() != NULL && $student->document()->where('type', $document_type)->first() != NULL)
            {{-- SUBMIT DOCUMENTS --}}
            <div class="col-12 px-0">
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Required Documents has been uploaded</h4>
                <p>Submit your documents for approval</p>
                <p>You cannot change the documents once you click on Submit</p>
                <hr>
                <button class="btn btn-outline-primary" id="btnSubmitDocs" onclick="submitDocuments()">Submit Documents <span id="spinnerSubmitDocs" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
              </div>
            </div>

              {{-- SHOW UPLOADED BC IMAGES --}}
              <div class="col-12 mt-4 px-0">
                <div class="card">
                  <div class="card-header">Birth Certificate</div>
                  <div class="card-body pt-2">
                    <div class="form-row">
                      <div class="col-lg">
                        <div class="form-group">
                          <span class="form-text text-muted">Front Image</span>
                          <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', 'birth')->where('side', 'front')->first()->image)}}) no-repeat center; background-size: cover;"></div>
                        </div>
                      </div>
                      <div class="col-lg">
                        <div class="form-group">
                          <span class="form-text text-muted">Back Image</span>
                          <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', 'birth')->where('side', 'back')->first()->image)}}) no-repeat center; background-size: cover;"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row justify-content-end">
                      <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2">
                          <button type="button" class="btn btn-outline-danger form-control" id="btnDeleteBirth" role="button" aria-expanded="false" aria-controls="declaration" onclick="delete_birth()">
                            Delete
                            <span id="spinnerDeleteBirth" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                          </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- /SHOW UPLOADED BC IMAGES --}}

              {{-- SHOW UPLOADED ID FRONT --}}
              <div class="col-12 mt-4 px-0">
                <div class="card">
                  <div class="card-header">{{$document_type}}</div>
                  <div class="card-body pt-2">
                    <div class="form-row">
                      <div class="col-lg">
                        <div class="form-group">
                          <span class="form-text text-muted">Front Image</span>
                          <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', $document_type)->where('side', 'front')->first()->image) ?? ''}}) no-repeat center; background-size: cover;"></div>
                        </div>
                      </div>
                      {{-- SHOW BACK IMAGE IF NIC OLD --}}
                      @if($student->nic_old != NULL) 
                      <div class="col-lg">
                        <div class="form-group">
                          <span class="form-text text-muted">Back Image</span>
                          <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', $document_type)->where('side', 'back')->first()->image)?? ''}}) no-repeat center; background-size: cover;"></div>
                        </div>
                      </div>
                      @endif
                      {{-- /SHOW BACK IMAGE IF NIC OLD --}}
                    </div>
                    <div class="form-row justify-content-end">
                      <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2">
                          <button type="button" class="btn btn-outline-danger form-control" id="btnDeleteID" role="button" aria-expanded="false" aria-controls="DeleteID" onclick="delete_ID()">
                            Delete
                            <span id="spinnerDeleteID" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                          </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- /SHOW UPLOADED ID FRONT IMAGE --}}
            {{-- /SUBMIT DOCUMENTS --}}
            
          {{-- IF ALL UNCOMPLETE --}}
          @else

            {{-- DOCUMENT DECLINED CHECK --}}
            @if ($registration->document_submit == 0 && $registration->document_status == 'Declined')
              {{-- DOCUMENT DECLINED --}}
              <div class="col-12 px-0">
                <div class="alert alert-danger" role="alert">
                  <h4 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Documents Declined!</h4>
                  <p>{{ $registration->declined_msg }}</p>
                  <hr>
                  <p class="font-weight-bold mb-0">Please upload correct document images</p>
                  <p class="font-weight-bold mb-0">If you think this was mistaken resubmit documents and send an email attached with your documents and  to <a href="mailto:{{ App\Models\Contact::where('type', 'coordinator')->first()->email }}">FIT Co-ordinator ({{ App\Models\Contact::where('type', 'coordinator')->first()->email }})</a></p>
                  </div>
              </div>
              {{-- /DOCUMENT DECLINED --}}
            @endif
            {{-- / DOCUMENT DECLINED CHECK --}}

            {{-- CHECK BC UPLOADED --}}
            @if($student->document()->where('type', 'birth')->where('side', 'front')->first() == NULL || $student->document()->where('type', 'birth')->where('side', 'back')->first() == NULL)
              <!-- UPLOAD BIRTH CERTIFICATE -->
              <div class="col-12 mt-4 px-0">
                <div class="card">
                  <div class="card-header">Birth Certificate</div>
                  <div class="card-body pt-2">
                    <span><strong>Please upload clear images of both the sides of the birth certificate and the NIC. All your details must be clearly visible in the images.</strong> </span> 
                    <form id="birthCertificateForm">  
                      <div class="form-row">
                        @if($student->document()->where('type', 'birth')->where('side', 'front')->first() == NULL)
                        <div class="col-lg">
                          <div class="form-group">
                            <small id="birthCertificateHelp" class="form-text text-muted">Upload the scanned front side of the birth certificate here (JPEG/ PNG). Maximum file size: 5mb</small>
                            <div class="drop-zone">
                              <span class="drop-zone__prompt">Scanned Birth Certificate (Front)<br><small>Drop image here or click to select file</small> </span>
                              <input type="file" name="birthCertificateFront" id="birthCertificateFront" class="drop-zone__input form-control"/>
                            </div>
                            <span class="invalid-feedback birth" id="error-birthCertificateFront" role="alert"></span>
                          </div>
                        </div>
                        @endif
                        @if($student->document()->where('type', 'birth')->where('side', 'back')->first() == NULL)
                        <div class="col-lg">
                          <div class="form-group">
                            <small id="birthCertificateHelp" class="form-text text-muted">Upload the scanned rear(other) side of the birth certificate here (JPEG/ PNG). Maximum file size: 5mb</small>
                            <div class="drop-zone">
                              <span class="drop-zone__prompt">Scanned Birth Certificate (Back)<br><small>Drop image here or click to select file</small> </span>
                              <input type="file" name="birthCertificateBack" id="birthCertificateBack" class="drop-zone__input form-control"/>
                            </div>
                            <span class="invalid-feedback birth" id="error-birthCertificateBack" role="alert"></span>
                          </div>
                        </div>
                        @endif
                      </div>
                      <div class="form-row justify-content-end">
                        <div class="mt-3 col-xl-2 col-md-6 order-sm-1 order-3" id="divResetForm">
                            <button type="button" class="btn btn-secondary form-control" onclick="reset_form('#birthCertificateForm')">Discard</button>
                        </div>
                        <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveBirth">
                            <button type="button" class="btn btn-outline-primary form-control" id="btnSaveBirth" role="button" aria-expanded="false" aria-controls="upload birth" onclick="upload_birth()">
                              Upload
                              <span id="spinnerBirth" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /UPLOAD BIRTH CERTIFICATE-->
            @else
              {{-- SHOW UPLOADED BC IMAGES --}}
              <div class="col-12 mt-4 px-0">
                <div class="card">
                  <div class="card-header">Birth Certificate</div>
                  <div class="card-body pt-2">
                    <div class="form-row">
                      <div class="col-lg">
                        <div class="form-group">
                          <span class="form-text text-muted">Front Image</span>
                          <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', 'birth')->where('side', 'front')->first()->image)}}) no-repeat center; background-size: cover;"></div>
                        </div>
                      </div>
                      <div class="col-lg">
                        <div class="form-group">
                          <span class="form-text text-muted">Back Image</span>
                          <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', 'birth')->where('side', 'back')->first()->image)}}) no-repeat center; background-size: cover;"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-row justify-content-end">
                      <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2">
                          <button type="button" class="btn btn-outline-danger form-control" id="btnDeleteBirth" role="button" aria-expanded="false" aria-controls="declaration" onclick="delete_birth()">
                            Delete
                            <span id="spinnerDeleteBirth" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                          </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- /SHOW UPLOADED BC IMAGES --}}

              {{-- CHECK ID UPLOADED --}}
              @if($student->document()->where('type', $document_type)->where('side', 'front')->first() == NULL)
                <!-- UPLOAD UNIQUE ID -->
                <div class="col-12 mt-5 px-0">
                  <div class="card">
                    <div class="card-header">Valid identification document with a photograph</div>
                    <div class="card-body pt-2">            
                      <span><strong>Please Upload a clear image with your details and the photograph is clearly visible</strong> </span>  
                      <form id="idDocumentForm">                
                        <div class="form-row">               
                          <div class="col">
                            <div class="form-group">
                              <small id="documentFrontHelp" class="form-text text-muted">Upload your scanned front side of the {{ $document_type }} here in JPEG/ PNG file format. Maximum file size: 5mb</small>
                              <div class="drop-zone">
                                <span class="drop-zone__prompt">Scanned {{ $document_type }} Front<br><small>Drop image here or click to select file</small> </span>
                                <input type="file" name="documentFront" id="documentFront" class="drop-zone__input form-control"/>
                              </div>
                              <span class="invalid-feedback id-doc" id="error-documentFront" role="alert"></span>
                            </div>
                          </div>
                          @if($student->nic_old != NULL) 
                          <div class="col">
                            <div class="form-group">
                              <small id="documentBackHelp" class="form-text text-muted">Upload your scanned rear (other) side of the {{ $document_type }} here in JPEG/ PNG file format. Maximum file size: 5mb</small>
                              <div class="drop-zone">
                                <span class="drop-zone__prompt">Scanned {{ $document_type }} Back<br><small>Drop image here or click to select file</small> </span>
                                <input type="file" name="documentBack" id="documentBack" class="drop-zone__input form-control"/>
                              </div>
                              <span class="invalid-feedback id-doc" id="error-documentBack" role="alert"></span>
                            </div>
                          </div>
                          @endif
                        </div>
                        <div class="form-row justify-content-end">
                          <div class="mt-3 col-xl-2 col-md-6 order-sm-1 order-3" id="divResetForm">
                              <button type="button" class="btn btn-secondary form-control" onclick="reset_form('#idDocumentForm')">Discard</button>
                          </div>
                          <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveId">
                              <button type="button" class="btn btn-outline-primary form-control" id="btnSaveId" role="button" aria-expanded="false" aria-controls="save ID" onclick="upload_id('{{ $document_type }}')">
                                Upload
                                <span id="spinnerId" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                              </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /UPLOAD UNIQUE ID -->
              @else
                {{-- SHOW UPLOADED ID FRONT --}}
                <div class="col-12 mt-4 px-0">
                  <div class="card">
                    <div class="card-header">{{$document_type}}</div>
                    <div class="card-body pt-2">
                      <div class="form-row">
                        <div class="col-lg">
                          <div class="form-group">
                            <span class="form-text text-muted">Front Image</span>
                            <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', $document_type)->where('side', 'front')->first()->image)}}) no-repeat center; background-size: cover;"></div>
                          </div>
                        </div>
                        {{-- SHOW BACK IMAGE IF NIC OLD --}}
                        @if($student->nic_old != NULL) 
                        <div class="col-lg">
                          <div class="form-group">
                            <span class="form-text text-muted">Back Image</span>
                            <div class="drop-zone" style="background: url({{ asset('storage/students/'.$student->id.'/'.$student->document()->where('type', $document_type)->where('side', 'back')->first()->image)}}) no-repeat center; background-size: cover;"></div>
                          </div>
                        </div>
                        @endif
                        {{-- /SHOW BACK IMAGE IF NIC OLD --}}
                      </div>
                      <div class="form-row justify-content-end">
                        <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2">
                            <button type="button" class="btn btn-outline-danger form-control" id="btnDeleteID" role="button" aria-expanded="false" aria-controls="DeleteID" onclick="delete_ID()">
                              Delete
                              <span id="spinnerDeleteID" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- /SHOW UPLOADED ID FRONT IMAGE --}}
              @endif
              {{-- /CHECK ID UPLOADED --}}
            @endif
            {{-- CHECK BC UPLOADED --}}
          @endif
          {{-- /IF ALL COMPLETE SHOW SUBMIT DOCUMENTS BUTTON --}}
        @endif
        {{-- /DOCUMENT SUBMIT CHECK --}}



        {{-- DOCUMENT SUBMIT CHECK --}}
        @if($registration->document_submit == 1 && $registration->document_status != 'Declined')
        @else
          {{-- IF ALL COMPLETE SHOW SUBMIT DOCUMENTS BUTTON --}}
          @if($student->document()->where('type', 'birth')->first() != NULL && $student->document()->where('type', $document_type)->first() != NULL)
            {{-- SUBMIT DOCUMENTS --}}
            <div class="col-12 px-0 my-4">
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Required Documents has been uploaded</h4>
                <p>Submit your documents for approval</p>
                <p>You cannot change the documents once you click on Submit</p>
                <hr>
                <button class="btn btn-outline-primary" id="btnSubmitDocs" onclick="submitDocuments()">Submit Documents <span id="spinnerSubmitDocs" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span></button>
              </div>
            </div>
          @endif
        @endif

      </div>
    </div>
    <!-- /CONTENT -->
    
    @include('portal.student.documents.scripts')
@endsection
