<!-- CREATE -->
<div class="modal fade" id="modal-create-announcement" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUserRole">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"/>
            <span class="invalid-feedback" id="error-title" role="alert"></span>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control ckeditor" id="description" name="description"></textarea>
            <span class="invalid-feedback" id="error-description" role="alert"></span>
          </div>
          {{-- <div class="form-group pt-3">          
            <label for="image">Image</label>
            <div class="drop-zone">
              <span class="drop-zone__prompt">Drop Results File here or click to upload</span>
              <input type="file" name="image" id="image" class="drop-zone__input"/>
            </div>
            <span class="invalid-feedback" id="error-image" role="alert"></span>
          </div> --}}
          {{-- <div class="form-group">
            <label for="buttonText">Button Text</label>
            <input type="text" class="form-control" id="buttonText" name="buttonText" placeholder="e.g. Click Here"/>
            <span class="invalid-feedback" id="error-buttonText" role="alert"></span>
          </div>                        
          <div class="form-group">
            <label for="buttonLink">Button Link</label>
            <select id="buttonLink" name="buttonLink" class="form-control form-control-sm">
              <option value="">select here---</option>
              <option value="student.registration">Student Portal Registration</option>
              <option value="student.home">Website Registration</option>
              <option value="student.exam">Exams</option>
              <option value="student.results">Results</option>
            </select>
            <span class="invalid-feedback" id="error-buttonLink" role="alert"></span>
          </div>   --}}
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
        <button type="button" id="btnCreateAnnouncement" class="btn btn-outline-primary" onclick="create_announcement()">Create</button>
      </div>
    </div>
  </div>
</div>
<!--/ CREATE -->

{{-- <!-- Edit -->
<div class="modal fade" id="modal-edit-announcement" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUserRole">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"/>
            <span class="invalid-feedback" id="error-title" role="alert"></span>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description"/>
            <span class="invalid-feedback" id="error-description" role="alert"></span>
          </div>
          <div class="form-group pt-3">          
            <label for="image">Image</label>
            <div class="drop-zone">
              <span class="drop-zone__prompt">Drop Results File here or click to upload</span>
              <input type="file" name="image" id="image" class="drop-zone__input"/>
            </div>
            <span class="invalid-feedback" id="error-image" role="alert"></span>
          </div>
          <div class="form-group">
            <label for="buttonText">Button Text</label>
            <input type="text" class="form-control" id="buttonText" name="buttonText" placeholder="e.g. Click Here"/>
            <span class="invalid-feedback" id="error-buttonText" role="alert"></span>
          </div>                        
          <div class="form-group">
            <label for="buttonLink">Button Link</label>
            <select id="buttonLink" name="buttonLink" class="form-control form-control-sm">
              <option value="">select here---</option>
              <option value="student.registration">Student Portal Registration</option>
              <option value="student.home">Website Registration</option>
              <option value="student.exam">Exams</option>
              <option value="student.results">Results</option>
            </select>
            <span class="invalid-feedback" id="error-buttonLink" role="alert"></span>
          </div>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
        <button type="button" id="btnCreateAnnouncement" class="btn btn-outline-primary" onclick="create_announcement()">Create</button>
      </div>
    </div>
  </div>
</div>
<!--/ Edit --> --}}

