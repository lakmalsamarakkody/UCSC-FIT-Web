{{-- USER ROLE --}}

  <!-- VIEW -->
  <div class="modal fade" id="view-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">System Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Permission List</h5>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-md-6"><i class="fas fa-check"></i>view-dashboard</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i> add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i> add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i> add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i> add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i> add-user</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ VIEW -->

  <!-- EDIT -->
  <div class="modal fade" id="edit-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">System Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Permission List</h5>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-md-6"><input type="checkbox" name="permission" value="view-dashboard" checked> view-dashboard</div>
              <div class="col-lg-3 col-md-6"><input type="checkbox" name="permission" value="view-dashboard"> add-user</div>
              <div class="col-lg-3 col-md-6"><input type="checkbox" name="permission" value="view-dashboard"> add-user</div>
              <div class="col-lg-3 col-md-6"><input type="checkbox" name="permission" value="view-dashboard"> add-user</div>
              <div class="col-lg-3 col-md-6"><input type="checkbox" name="permission" value="view-dashboard"> add-user</div>
              <div class="col-lg-3 col-md-6"><input type="checkbox" name="permission" value="view-dashboard"> add-user</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->

{{-- /USER ROLE --}}

{{-- SUBJECTS --}}
  <!-- EDIT -->
  <div class="modal fade" id="edit-subject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">FIT 103 - ICT Applications</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputScode">Subject Code</label>
              <input type="Scode" class="form-control" id="InputScode" aria-describedby="ScodeHelp"/>
              <small id="ScodeHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="InputSname">Name</label>
              <input type="text" class="form-control" id="InputSname"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{-- /SUBJECTS --}}

{{-- EXAM TYPE --}}
  <!-- EDIT -->
  <div class="modal fade" id="edit-exam-type" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">e-Test</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputEname">Name</label>
              <input type="Ename" class="form-control" id="InputEname" aria-describedby="EnameHelp"/>
              <small id="EnameHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{-- /EXAM TYPE --}}
    