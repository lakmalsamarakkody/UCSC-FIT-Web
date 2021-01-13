{{-- PROFILE PICTURE --}}
  <div class="modal fade" id="modal-profile-picture" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Profile Picture</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
            <form id="profilePicForm">
              <div class="form-row">
                <div class="form-group col">
                  <label for="resultFile">Upload a new image here</label>
                  <div class="drop-zone">
                    <span class="drop-zone__prompt">Drag & Drop Image File here or click to upload</span>
                    <input type="file" name="profileImage" id="profileImage" class="drop-zone__input"/>
                  </div>
                  <span class="invalid-feedback birth" id="error-profileImage" role="alert"></span>
                </div>
              </div>
              
            </form>
            <span class="alert alert-danger d-block text-center " role="alert">Avoid upploading inappropiate images! Accounts with such images will be banned without notice.</span>
            
            <div class="float-right">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
              <button type="button" id="btnUploadProfilePic" class="btn btn-outline-primary" onclick="upload_profile_pic()">
              Upload
               <span id="spinnerprofilePic" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              </button>
            </div>
        </div>
        <div class="modal-footer d-block px-5">

          <h6>
            Or Select a previous Image</h6>
          <div class="past-img float-left">          
          @foreach(File::glob(public_path('storage/portal/avatar/'.Auth::user()->id).'/*') as $path)
          <button class="btn btn-link" onclick="select_profile_pic('{{ str_replace(public_path(), '', $path) }}')">
            <img src="{{ url('') }}{{ str_replace(public_path(), '', $path) }}" width="50px">
          </button>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- /PROFILE PICTURE --}}

