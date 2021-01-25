<!-- VIEW APPLICANT DETAILS -->
<div class="modal fade" id="modal-view-applicant" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewApplication" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApplication"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="card shadow-none">
                    <div class="card-header pb-0">Application</div>
                    <div class="card-body pb-0">                        
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-left">
                                    <tr>
                                        <th>Submitted on: </th>
                                        <td><span id="spanSubmittedOn"></span> <small class="text-muted">(MM/DD/YY)</small></td>                                        
                                    </tr>
                                    <tr>
                                        <th>Type: </th>
                                        <td>Registration</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- APPROVED STATUS --}}
                <div class="card shadow-none">
                    <div class="card-header pb-0">Approval Status</div>
                    <div class="card-body pb-0 text-main-theme">                        
                        <div class="row">
                            <div class="col-lg-4">Details : <i id="iconDetailStatus" class="fas"></i> <span id="spanDetailStatus"></span></div>
                            <div class="col-lg-4">Payment : <i id="iconPaymentStatus" class="fas"></i> <span id="spanPaymentStatus"></span></div>
                            <div class="col-lg-4">Documents : <i id="iconDocumentsStatus" class="fas"></i> <span id="spanDocumentsStatus"></span></div>
                        </div>
                    </div>
                </div>
                {{-- /APPROVED STATUS --}}

                <h6 class="card-header mt-4 mb-2">Applicant Information</h6>

                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="col-lg-12 information">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                Personal Details
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 order-md-1 order-2">
                                                        <table id="tblPersonal" class="table">
                                                            <tr>
                                                                <th>Title:</th>
                                                                <td><span id="spanTitle"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>First Name:</th>
                                                                <td><span id="spanFirstName"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Middle Names:</th>
                                                                <td><span id="spanMiddleNames"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Initials:</th>
                                                                <td><span id="spanInitials"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Last Name:</th>
                                                                <td><span id="spanLastName"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Full Name:</th>
                                                                <td><span id="spanFullName"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Gender:</th>
                                                                <td><i id="iconGender" class="fa fa-lg"></i><span id="spanGender"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Date of Birth:</th>
                                                                <td><span id="spanDOB"></span> <small class="text-muted">(MM/DD/YY)</small></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Citizenship:</th>
                                                                <td><span id="spanCitizenship"></span></td>
                                                            </tr>
                                                            {{-- <tr>
                                                                <th>NIC/ Postal/ Passport No:</th>
                                                                <td>9012256545V</td>
                                                            </tr> --}}
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                Education Qualifications
                                            </div>
                                            <div class="card-body">                        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Highest Qualification</th>
                                                                <td><span id="spanEducation"></span></td>                                        
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-3 contact">
                                            <div class="card-header ">
                                                Contact Details
                                            </div>
                                            <div class="card-body">     
                                                <div class="row">                                               
                                                    <div class="col-12 col-lg-6">
                                                        <h6>Permanent Address:</h6>
                                                        <hr>
                                                        <div class="ml-lg-4">
                                                            <p><span id="spanHouseNo"></span></p>  
                                                            <p><span id="spanAddress1"></span></p>
                                                            <p><span id="spanAddress2"></span></p>  
                                                            <p><span id="spanAddress3"></span></p>  
                                                            <p><span id="spanAddress4"></span></p>
                                                            <p><span id="spanCity"></span></p>
                                                            <p><span id="spanState"></span></p> 
                                                            <p><span id="spanCountry"></span></p> 
                                                        </div>
                                                    </div>                    
                                                    <div class="col-12 col-lg-6">
                                                        <h6>Current Address:</h6>
                                                        <hr>
                                                        <div class="ml-lg-4">
                                                            <p><span id="spanCurrentHouseNo"></span></p>  
                                                            <p><span id="spanCurrentAddress1"></span></p>
                                                            <p><span id="spanCurrentAddress2"></span></p>  
                                                            <p><span id="spanCurrentAddress3"></span></p>  
                                                            <p><span id="spanCurrentAddress4"></span></p>
                                                            <p><span id="spanCurrentCity"></span></p>
                                                            <p><span id="spanCurrentState"></span></p> 
                                                            <p><span id="spanCurrentCountry"></span></p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Telephone No:</th>
                                                                <td>+<span id="spanTelephoneCode"></span> <span id="spanTelephone"></span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-12 col-lg-6">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Email:</th>
                                                                <td><span id="spanEmail"></span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                Employment Details
                                            </div>
                                            <div class="card-body">                        
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Designation:</th>
                                                                <td><span id="spanDesignation"></span></td>                                        
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                <div id="divBtnApproveApplication" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApproveApplication">Approve <span id="spinnerBtnApproveApplication" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                                <div id="divBtnDeclineApplication" class="btn-group col-xl-3 col-lg-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message-application" id="btnDeclineApplication" data-toggle="modal">Decline <span id="spinnerBtnDeclineApplication" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-12 order-md-1 order-2">
                                                <table class="table text-left">
                                                    <tr>
                                                        <th>Date: </th>
                                                        <td><span id="spanPaymentDate"></span></td>                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank: </th>
                                                        <td><span id="spanPaymentBank"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch: </th>
                                                        <td><span id="spanPaymentBankBranch"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch Code: </th>
                                                        <td><span id="spanPaymentBankBranchCode"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Amount: </th>
                                                        <td>Rs.<span id="spanPaymentAmount"></span></td>
                                                    </tr>
                                                </table>
                                                <div name="imgPaymentBankSlip" id="imgPaymentBankSlip" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApprovePayment">Approve <span id="spinnerBtnApprovePayment" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message-payment" id="btnDeclinePayment" data-toggle="modal">Decline</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header">Birth Certificate</div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div name="imgBirthFront" id="imgBirthFront" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div name="imgBirthBack" id="imgBirthBack" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div id="divBtnDeclineDocumentBirth" class="btn-group col-xl-3 col-md-6 col-12 px-0">
                                            <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message-document-birth" id="btnDeclineDocumentBirth" data-toggle="modal">Decline</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header">Nic/Postal/Passport</div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table text-left">
                                                    <tr>
                                                        <th>Type: </th>
                                                        <td><span id="spanIdType"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NIC/Postal/Passport No: </th>
                                                        <td><span id="spanIdentity"></span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-lg">
                                                <div name="imgIdFront" id="imgIdFront" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                            <div class="col-lg">
                                                <div name="imgIdBack" id="imgIdBack" class="drop-zone" style="background:no-repeat center; background-size: cover;" ></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div id="divBtnDeclineDocumentId" class="btn-group col-xl-3 col-md-6 col-12 px-0">
                                            <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message-document-Id" id="btnDeclineDocumentId" data-toggle="modal">Decline</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                <div id="divBtnApproveDocuments" class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApproveDocuments">Approve <span id="spinnerBtnApproveDocuments" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnCheckLater" data-dismiss="modal">Check Later</button>
            </div>
        </div>
    </div>

</div>
<!-- /VIEW APPLICANT DETAILS -->

<!-- DECLINE MESSAGE : APPLICATION -->
<div class="modal fade" id="modal-decline-message-application" tabindex="-1" aria-labelledby="declineMessageApplicationLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineMessageApplicationLabel">Decline Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="declineMessageApplication" class="col-form-label">Message</label>
                    <textarea class="form-control" name="declineMessage" id="declineMessageApplication" cols="30" rows="10" placeholder="If you need to send a specilized message to apllicant enter it here. If not default message will be sent."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnDeclineApplicationModal" type="button" class="btn btn-warning">Decline <span id="spinnerBtnDeclineApplication" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>
<!-- /DECLINE MESSAGE : APPLICATION -->

<!-- DECLINE MESSAGE : PAYMENT -->
<div class="modal fade" id="modal-decline-message-payment" tabindex="-1" aria-labelledby="declineMessagepaymentLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineMessagePaymentLabel">Decline Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="declineMessagePayment" class="col-form-label">Message</label>
                    <textarea class="form-control" name="declineMessage" id="declineMessagePayment" cols="30" rows="10" placeholder="If you need to send a specilized message to apllicant enter it here. If not default message will be sent."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnDeclinePaymentModal" type="button" class="btn btn-warning">Decline <span id="spinnerBtnDeclinePayment" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>
<!-- /DECLINE MESSAGE : PAYMENT -->

<!-- DECLINE MESSAGE : DOCUMENT BIRTH -->
<div class="modal fade" id="modal-decline-message-document-birth" tabindex="-1" aria-labelledby="declineMessagedocumentBirthLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineMessageDocumentBirthLabel">Decline Birth Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="declineMessageDocumentBirth" class="col-form-label">Message</label>
                    <textarea class="form-control" name="declineMessage" id="declineMessageDocumentBirth" cols="30" rows="10" placeholder="If you need to send a specilized message to apllicant enter it here. If not default message will be sent."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnDeclineDocumentBirthModal" type="button" class="btn btn-warning">Decline <span id="spinnerBtnDeclineDocumentBirth" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>
<!-- /DECLINE MESSAGE : BIRTH -->

<!-- DECLINE MESSAGE : DOCUMENT ID -->
<div class="modal fade" id="modal-decline-message-document-Id" tabindex="-1" aria-labelledby="declineMessagedocumentIdLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineMessageDocumentIdLabel">Decline ID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="declineMessageDocumentId" class="col-form-label">Message</label>
                    <textarea class="form-control" name="declineMessage" id="declineMessageDocumentId" cols="30" rows="10" placeholder="If you need to send a specilized message to apllicant enter it here. If not default message will be sent."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnDeclineDocumentIdModal" type="button" class="btn btn-warning">Decline <span id="spinnerBtnDeclineDocumentId" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>
<!-- /DECLINE MESSAGE : Id -->

{{-- REGISTER STUDENT --}}
<div class="modal fade" id="modal-register-student" tabindex="-1" aria-labelledby="registerStudentLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerStudentLabel">Register Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- STUDENT NAME --}}
                <div class="form-group">
                    <label for="regStudentEmail" class="col-form-label">Email:</label><br/>
                    <label name="regStudentEmail" id="regStudentEmail" class="text-info font-weight-bold"></label>
                </div>

                <div class="form-group">
                    <label for="regDate" class="col-form-label">Registration Date:</label>
                    <input type="date" class="form-control" name="regDate" id="regDate" value="{{ $regDate ?? NULL }}"/>
                </div>

                <div class="form-group">
                    <label for="regExpireDate" class="col-form-label">Registration Expires On:</label>
                    <input type="date" class="form-control" name="regExpireDate" id="regExpireDate" value="{{ $regExpireDate ?? NULL }}"/>
                </div>

                <div class="form-group">
                    <label for="regStatus" class="col-form-label">Status:</label>
                    <select class="form-control" name="regStatus" id="regStatus">
                        <option value="1" selected>Active</option>
                        <option value="0">Deactive</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnRegisterStudent" type="button" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Register <span id="spinnerBtnRegisterStudent" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
</div>
{{-- /REGISTER STUDENT --}}


