<!-- VIEW APPLICANT DETAILS -->
<div class="modal fade" id="modal-download-student-list" data-keyboard="false" tabindex="-1" aria-labelledby="downloadStudentListModal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase font-weight-bold" id="viewApplicationTitle">Download Students List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">   
                <a class="btn btn-success w-100 mb-3" href="{{ url('/portal/staff/student/list/export/all/') }}">Download All Students</a>
            
                <p>Last Version: <strong>ver {{ $current_download_version->id ?? 0}}</strong> downloaded on: <strong>{{ $current_download_version->created_at ?? '' }}</strong></p>
                
                <label for="ver">Downloading Version:</label>
                <div class="input-group input-group-md">                    
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">ver </span>
                    </div>
                    <input type="number" class="form-control" id="ver" aria-describedby="ver" value="{{ $current_download_version->id+1 }}"/>
                </div>

                <a class="btn btn-info w-100 mt-3" href="{{ url('/portal/staff/student/list/export/') }}">Download Version <span class="version">{{ $current_download_version->id+1 }}</span> (Trail)</a>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" onclick="download_latest_version()">Download Version <span class="version">{{ $current_download_version->id+1 }}</span></button>
                <p class="text-center">If clicked, the version will be updated to the next version (given above)</p>
                <p class="text-center">To download previous versions, type the version number in  "Downloading Version" field and click "Download Latest Version" (Red Button)</p>
            </div>
        </div>
    </div>

</div>
<!-- /VIEW APPLICANT DETAILS -->



