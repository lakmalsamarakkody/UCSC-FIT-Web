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

    @if($student->flag->payment_approve==0)
    <div class="col-12">
      <div class="alert alert-success border-success">
          <h4 class="my-4">Application Submitted</h4>
          <p style="font-weight: bold;">Please wait for Administrator Approval</p>
      </div>
    </div>
    @else
      <!-- UPLOAD BIRTH CERTIFICATE -->
      <div class="col-12 mt-2 px-0">
        <div class="card">
          <div class="card-header pb-0">Birth Certificate</div>
          <div class="card-body pt-2">
            <span><strong>Please Upload clear images of both sides of the birth certificate with your details are clearly visible</strong> </span> 
            <form id="birthCertificateForm">  
              <div class="form-row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <small id="birthCertificateHelp" class="form-text text-muted">Upload your scanned front side of the birth certificate here in JPEG/ PNG file format</small>
                    <div class="drop-zone">
                      <span class="drop-zone__prompt">Scanned Birth Cettificate (Front)<br><small>Drop image File here or click to upload</small> </span>
                      <input type="file" name="birthCertificateFront" id="birthCertificateFront" class="drop-zone__input form-control"/>
                    </div>
                    <span class="invalid-feedback birth" id="error-birthCertificateFront" role="alert"></span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <small id="birthCertificateHelp" class="form-text text-muted">Upload your scanned reverse side of the birth certificate here in JPEG/ PNG file format</small>
                    <div class="drop-zone">
                      <span class="drop-zone__prompt">Scanned Birth Cettificate (Back)<br><small>Drop image File here or click to upload</small> </span>
                      <input type="file" name="birthCertificateBack" id="birthCertificateBack" class="drop-zone__input form-control"/>
                    </div>
                    <span class="invalid-feedback birth" id="error-birthCertificateBack" role="alert"></span>
                  </div>
                </div>
              </div>
              <div class="form-row justify-content-end">
                <div class="mt-3 col-xl-2 col-md-6 order-sm-1 order-3" id="divResetForm">
                    <button type="button" class="btn btn-secondary form-control" id="btnResetForm" onclick="reset_form()">Discard</button>
                </div>
                <div class="mt-3 col-xl-3 col-md-6 order-sm-2 order-2" id="divSaveInformation">
                    <button type="button" class="btn btn-outline-primary form-control" id="btnSaveBirth" role="button" aria-expanded="false" aria-controls="declaration" onclick="upload_birth()">
                      Upload
                      <span id="spinnerBirth" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span>
                    </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /UPLOAD BIRTH CERTIFICATE-->

      <!-- APPLIED EXAMS TABLE -->
      <div class="col-12 mt-4 px-0">
        <div class="card">
          <div class="card-header pb-0">Valid identification document with a photograph</div>
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
                    <button type="button" class="btn btn-secondary form-control" id="btnResetForm" onclick="reset_form()">Discard</button>
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
      <!-- /APPLIED EXAMS TABLE-->
    @endif




      </div>
    </div>
    <!-- /CONTENT -->
    
    @include('portal.student.documents.scripts')
@endsection
