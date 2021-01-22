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
              <p class="font-weight-bold mb-0">Upload your Your Scanned Birth Certificate and Unique Identification images (NIC / Passport / Postal ID) below here.. </p>
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
              <p>Your registration process will be completed after submitted documents are approved.</p>
              <hr>
              <p class="font-weight-bold mb-0">If your registration didn't get approved within 2 weeks please send an email to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
            </div>
          </div>
          {{-- /DOCUMENT APPROVAL PENDING --}}

          {{-- SUBMIT HARD COPIES --}}
          <div class="col-12 px-0">
            <div class="alert alert-danger" role="alert">
              <h3 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> POST YOUR APPLICATION, PAYMENT SLIP, IDENTITY DOCUMENTS </h3>
              <p>Make sure to post your </p>
                <p><i>
                application - <button type="button" class="btn btn-sm btn-outline-danger" onclick="window.location.href='/portal/student/information'"> Application </button><br/>
                payment slip - - Previously uploaded Scanned Payment Slip <br/>
                documents (Birth Certificate and NIC/Postal/Passport image Copies) - Previously uploaded Scanned Images<br/>
                </i></p>
              <p>
              through register post. <br/>
              Posting above mentioned documents are mandatory in completion of your registration process.</p>
              <hr>
              <span>Address to post the FIT Application,Payment Slip and Documents: </span>
              <p class="font-weight-bold mb-0">
                Senior Assistant Registrar (EDC),<br/>
                External Degrees Centre of UCSC,<br/>
                University of Colombo School of Computing,<br/>
                No. 35, Reid Avenue,<br/>
                Colombo 07,<br/>
                Sri Lanka.
              </p>
            </div>
          </div>
          {{-- /SUBMIT HARD COPIES --}}
        
        {{-- DOCUMENTS NOT SUBMITTED --}}
        @else

          {{-- IF ALL COMPLETE SHOW SUBMIT DOCUMENTS BUTTON --}}
          @if($student->document()->where('type', 'birth')->first() != NULL && $student->document()->where('type', 'NIC')->orWhere('type', 'Postal')->orWhere('type', 'Passport')->first() != NULL)
            {{-- SUBMIT DOCUMENTS --}}
            <div class="col-12 px-0">
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Required Identification Documents has been uploaded</h4>
                <p>Submit your documents for approval</p>
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
                  <p class="font-weight-bold mb-0">If you think this was mistaken resubmit documents and send an email attached with your documents and  to <a href="mailto:taw@ucsc.cmb.ac.lk">FIT Co-ordinator (taw@ucsc.cmb.ac.lk)</a></p>
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
                    <span><strong>Please Upload clear images of both sides of the birth certificate with your details are clearly visible</strong> </span> 
                    <form id="birthCertificateForm">  
                      <div class="form-row">
                        @if($student->document()->where('type', 'birth')->where('side', 'front')->first() == NULL)
                        <div class="col-lg">
                          <div class="form-group">
                            <small id="birthCertificateHelp" class="form-text text-muted">Upload your scanned front side of the birth certificate here in JPEG/ PNG file format</small>
                            <div class="drop-zone">
                              <span class="drop-zone__prompt">Scanned Birth Certificate (Front)<br><small>Drop image File here or click to upload</small> </span>
                              <input type="file" name="birthCertificateFront" id="birthCertificateFront" class="drop-zone__input form-control"/>
                            </div>
                            <span class="invalid-feedback birth" id="error-birthCertificateFront" role="alert"></span>
                          </div>
                        </div>
                        @endif
                        @if($student->document()->where('type', 'birth')->where('side', 'back')->first() == NULL)
                        <div class="col-lg">
                          <div class="form-group">
                            <small id="birthCertificateHelp" class="form-text text-muted">Upload your scanned reverse side of the birth certificate here in JPEG/ PNG file format</small>
                            <div class="drop-zone">
                              <span class="drop-zone__prompt">Scanned Birth Certificate (Back)<br><small>Drop image File here or click to upload</small> </span>
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
                              <small id="documentFrontHelp" class="form-text text-muted">Upload your scanned front side of the {{ $document_type }} here in JPEG/ PNG file format</small>
                              <div class="drop-zone">
                                <span class="drop-zone__prompt">Scanned {{ $document_type }} Front<br><small>Drop image File here or click to upload</small> </span>
                                <input type="file" name="documentFront" id="documentFront" class="drop-zone__input form-control"/>
                              </div>
                              <span class="invalid-feedback id-doc" id="error-documentFront" role="alert"></span>
                            </div>
                          </div>
                          @if($student->nic_old != NULL) 
                          <div class="col">
                            <div class="form-group">
                              <small id="documentBackHelp" class="form-text text-muted">Upload your scanned reverse side of the {{ $document_type }} here in JPEG/ PNG file format</small>
                              <div class="drop-zone">
                                <span class="drop-zone__prompt">Scanned {{ $document_type }} Back<br><small>Drop image File here or click to upload</small> </span>
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

      </div>
    </div>
    <!-- /CONTENT -->
    
    @include('portal.student.documents.scripts')
@endsection
