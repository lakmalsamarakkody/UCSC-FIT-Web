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

        {{-- PAYMENT CHECK --}}
        @if($payment->status != 'OK')

          {{-- PAYMENT APPROVAL PENDING --}}
          <div class="col-12 px-0">
            <div class="alert alert-info" role="alert">
              <h4 class="alert-heading"><i class="far fa-check-circle"></i> Payment Submitted Successfully</h4>
              <p>Come back later to check whether your payment has beend approved.</p>
              <hr>
              <p class="font-weight-bold mb-0">Prepare Your Scanned Birth Certificate and Unique Identification images (NIC / Passport / Postal ID) </p>
            </div>
          </div>
          {{-- /PAYMENT APPROVAL PENDING --}}

        @elseif ($payment->status == 'OK')

          {{-- PAYMENT APPROVED --}}
          <div class="col-12 px-0">
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading"><i class="far fa-check-circle"></i> Payment Approved</h4>
              <p>Your payment has beend approved.</p>
              <hr>
              <p class="font-weight-bold mb-0">Upload your Your Scanned Birth Certificate and Unique Identification images (NIC / Passport / Postal ID) below here.. </p>
            </div>
          </div>
          {{-- /PAYMENT APPROVED --}}

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
                    <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveInformation">
                        <button type="button" class="btn btn-outline-primary form-control" id="btnSaveBirth" role="button" aria-expanded="false" aria-controls="declaration" onclick="upload_birth()">
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
                      <small class="form-text text-muted">Front Image</small>
                      <div class="drop-zone">
                        <img src="{{ asset('storage/students/1/1_birth_back_2021-01-06_1609917974.jpg')}}" width="50px"/>
                      </div>
                      <span class="invalid-feedback birth" id="error-birthCertificateFront" role="alert"></span>
                    </div>
                  </div>
                  <div class="col-lg">
                    <div class="form-group">
                      <small class="form-text text-muted">Back Image</small>
                      <div class="drop-zone">
                        <img src="{{ asset('storage/app/public/students/test.jpg')}}"/>
                      </div>
                      <span class="invalid-feedback birth" id="error-birthCertificateBack" role="alert"></span>
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
          @endif

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
                        <small id="documentFrontHelp" class="form-text text-muted">Upload your scanned front side of the {{ $document }} here in JPEG/ PNG file format</small>
                        <div class="drop-zone">
                          <span class="drop-zone__prompt">Scanned {{ $document }} Front<br><small>Drop image File here or click to upload</small> </span>
                          <input type="file" name="documentFront" id="documentFront" class="drop-zone__input form-control"/>
                        </div>
                        <span class="invalid-feedback id-doc" id="error-documentFront" role="alert"></span>
                      </div>
                    </div>
                    @if($student->nic_old != NULL) 
                    <div class="col">
                      <div class="form-group">
                        <small id="documentBackHelp" class="form-text text-muted">Upload your scanned reverse side of the {{ $document }} here in JPEG/ PNG file format</small>
                        <div class="drop-zone">
                          <span class="drop-zone__prompt">Scanned {{ $document }} Back<br><small>Drop image File here or click to upload</small> </span>
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
                    <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveInformation">
                        <button type="button" class="btn btn-outline-primary form-control" id="btnSaveId" role="button" aria-expanded="false" aria-controls="declaration" onclick="upload_id()">
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
        @endif
        {{-- /PAYMENT CHECK --}}

      </div>
    </div>
    <!-- /CONTENT -->
    
    @include('portal.student.documents.scripts')
@endsection
