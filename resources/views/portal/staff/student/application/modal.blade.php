<!-- VIEW APPLICANT DETAILS -->
<div class="modal fade" id="modal-view-applicant" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="viewApplication" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewApplication">Applicant Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 mt-3">
                    <div class="card shadow-none">
                        <div class="card-header"></div>
                        <div class="card-body">                        
                            <div class="row">
                                <div class="col-12">
                                    <table class="table text-left">
                                        <tr>
                                            <th>Submitted on: </th>
                                            <td><span id="spanSubmittedOn"></span></td>                                        
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
                </div>
                <div class="col-lg-12 mt-3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payments</a>
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
                                                    <div class="col-md-8 order-md-1 order-2">
                                                        <table class="table">
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
                                                                <td><i class="fa fa-lg fa-male"></i></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Date of Birth:</th>
                                                                <td><span id="spanDOB"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Citizenship:</th>
                                                                <td><span id="spanCitizenship"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th>NIC/ Postal/ Passport No:</th>
                                                                <td>9012256545V</td>
                                                            </tr>
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
                                                    <div class="col-12 col-md-6">
                                                        <h5>Permanent Address</h5>
                                                        <hr>
                                                        <div class="ml-lg-4">
                                                            <p><span id="spanHouseNo"></span></p>  
                                                            <p><span id="spanAddress1"></span></p>
                                                            <p><span id="spanAddress2"></span></p>  
                                                            <p><span id="spanAddress3"></span></p>  
                                                            <p><span id="spanAddress4"></span></p>
                                                            <p>City 1</p> 
                                                            <p>District/State</p>
                                                            <p>Sri Lanka</p> 
                                                        </div>
                                                    </div>                    
                                                    <div class="col-12 col-md-6">
                                                        <h5>Current Address</h5>
                                                        <hr>
                                                        <div class="ml-lg-4">
                                                            <p><span id="spanCurrentHouseNo"></span></p>  
                                                            <p><span id="spanCurrentAddress1"></span></p>
                                                            <p><span id="spanCurrentAddress2"></span></p>  
                                                            <p><span id="spanCurrentAddress3"></span></p>  
                                                            <p><span id="spanCurrentAddress4"></span> </p>
                                                            <p>District/State</p>
                                                            <p>City 2 </p> 
                                                            <p>Sri Lanka</p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Telephone No.</th>
                                                                <td>+<span id="spanTelephoneCode"></span> <span id="spanTelephone"></span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>johndoe@gmail.com</td>
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
                                                                <th>Designation</th>
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
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApproveInfo" onclick="approve_documents()">Approve</button>
                                </div>
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message" id="btnDeclineInfo" data-toggle="modal">Decline</button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-md-8 order-md-1 order-2">
                                                <table class="table text-left">
                                                    <tr>
                                                        <th>Date: </th>
                                                        <td>2020/12/21</td>                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Bank Branch Code: </th>
                                                        <td>600</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Paid Amount: </th>
                                                        <td>Rs.2750.00</td>
                                                    </tr>
                                                </table>
                                                <div class="col-lg-12 divImage text-center">
                                                    <img name="registerBankSlip" id="registerBankSlip" src="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApprovePayment" onclick="approve_documents()">Approve</button>
                                </div>
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message" id="btnDeclinePayment" data-toggle="modal">Decline</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header">Birth Certificate</div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-md-8 order-md-1 order-2">
                                                <div class="col-lg-12 divImage text-center">
                                                    <img name="imgBirthCertificate" id="imgBirthCertificate" src="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-header">Nic/Postal/Passport</div>
                                    <div class="card-body">                        
                                        <div class="row">
                                            <div class="col-md-8 order-md-1 order-2">
                                                <table class="table text-left">
                                                    <tr>
                                                        <th>Type: </th>
                                                        <td>NIC</td>
                                                    </tr>
                                                    <tr>
                                                        <th>NIC/Postal/Passport No: </th>
                                                        <td>960567896V</td>
                                                    </tr>
                                                </table>
                                                <div class="col-lg-12 divImage text-center">
                                                    <img name="imgNicPassport" id="imgNicPassport" src="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 col-12 text-center">
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-success form-control" id="btnApproveDocument" onclick="approve_documents()">Approve</button>
                                </div>
                                <div class="btn-group col-xl-3 col-md-6">
                                    <button type="button" class="btn btn-warning form-control" data-target="#modal-decline-message" id="btnDeclineDocument" data-toggle="modal">Decline</button>
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

<!-- DECLINE MESSAGE -->
<div class="modal fade" id="modal-decline-message" tabindex="-1" aria-labelledby="declineMessageLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="declineMessageLabel">Decline Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="declineMessage" class="col-form-label">Message</label>
                    <textarea class="form-control" name="declineMessage" id="declineMessage" cols="30" rows="10" placeholder="If you need to send a specilized message to apllicant enter it here. If not default message will be sent."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick="decline_application_payment()">Decline</button>
            </div>
        </div>
    </div>
</div>
<!-- /DECLINE MESSAGE -->

@include('portal.staff.student.application.scripts')


