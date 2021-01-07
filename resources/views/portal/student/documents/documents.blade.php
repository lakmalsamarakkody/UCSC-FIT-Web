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
        {{-- /PAYMENT CHECK --}}

      </div>
    </div>
    <!-- /CONTENT -->
    
    @include('portal.student.documents.scripts')
@endsection
