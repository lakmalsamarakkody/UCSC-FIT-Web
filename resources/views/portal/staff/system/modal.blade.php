{{-- USER ROLE --}}

  <!-- CREATE -->
  <div class="modal fade" id="modal-create-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create User Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputNewRoleName">Role Name</label>
              <input type="text" class="form-control" id="InputNewRoleName"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_role()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->

  <!-- VIEW -->
  <div class="modal fade" id="modal-view-role" tabindex="-1" role="dialog" aria-hidden="true">
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
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i>add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i>add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i>add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i>add-user</div>
              <div class="col-lg-3 col-md-6"><i class="fas fa-times"></i>add-user</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ VIEW -->

  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-role" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">System Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputRoleName">Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-warning" type="button" onclick="InputRoleName_editable();"><i class="fas fa-edit pr-0"></i></button>
                </div>
                <input type="text" class="form-control" id="InputRoleName" value="System Administrator" onfocusout="InputRoleName_readonly()" disabled/>
              </div>
            </div>
          
            <p class="mt-5">Permission List</p>

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
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_role()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->

{{-- /USER ROLE --}}

{{-- PERMISSION --}}

  <!-- CREATE -->
  <div class="modal fade" id="modal-create-permission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Permission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputNewPermissionName">Permission Name</label>
              <input type="text" class="form-control" id="InputNewPermissionName"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_permission()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->

  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-permission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">view-dashboard</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputPermissionName">Name</label>
              <input type="text" class="form-control" id="InputPermissionName" value="view-dashboard"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_permission()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->

{{-- /PERMISSION --}}

{{-- SUBJECTS --}}
  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-subject" tabindex="-1" role="dialog" aria-hidden="true">
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
              <label for="InputSubjectCode">Subject Code</label>
              <input type="Scode" class="form-control" id="InputSubjectCode" aria-describedby="ScodeHelp"/>
              <small id="ScodeHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="InputSubjectName">Name</label>
              <input type="text" class="form-control" id="InputSubjectName"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_subject()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{-- /SUBJECTS --}}

{{-- EXAM TYPE --}}
  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-exam-type" tabindex="-1" role="dialog" aria-hidden="true">
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
              <label for="InputExamTypeName">Name</label>
              <input type="Ename" class="form-control" id="InputExamTypeName" aria-describedby="ETnameHelp"/>
              <small id="ETnameHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_exam_type()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{-- /EXAM TYPE --}}

{{-- ACADEMIC YEAR --}}
  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-academic-year" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Academic Year - 2020</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputYear">Year</label>
              <select class="form-control" id="InputYear">
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
              </select>
              <small id="YearHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="InputYearStart">Start</label>
                <input type="date" class="form-control" id="InputYearStart"/>
              </div>
              <div class="form-group col-md-6">
                <label for="InputYearEnd">End</label>
                <input type="date" class="form-control" id="InputYearEnd"/>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_academic_year()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{--/ ACADEMIC YEAR --}}

{{-- STUDENT PHASE --}}
  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-student-phase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Phase 1 - Fresh User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputPhaseCode">Code</label>
              <input type="text" class="form-control" id="InputPhaseCode" aria-describedby="PhaseCodeHelp"/>
              <small id="PhaseCodeHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="InputPhaseDescription">Description</label>
              <input type="text" class="form-control" id="InputPhaseDescription" aria-describedby="PhaseDescHelp"/>
              <small id="PhaseDescHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_student_phase()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{--/ STUDENT PHASE --}}
    