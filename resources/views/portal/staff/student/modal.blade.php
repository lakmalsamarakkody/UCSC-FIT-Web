<!-- VIEW APPLICANT DETAILS -->
<div class="modal fade" id="modal-download-student-list" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="downloadStudentListModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase font-weight-bold" id="viewApplicationTitle">Download Students List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="card shadow-none">
                    <div class="card-body pb-0">                        
                        <div class="row justify-content-center">
                            <div class="col-12">

                                <a class="btn btn-success text-center" href="{{ url('/portal/staff/student/list/export/all/') }}">Download All Students</a>
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



