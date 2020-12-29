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
          <form id="formUserRole">
            <div class="form-group">
              <label for="newRoleName">Role Name</label>
              <input type="text" class="form-control" id="newRoleName" name="newRoleName"/>
              <span class="invalid-feedback" id="error-newRoleName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newRoleDescription">Role Description</label>
              <input type="text" class="form-control" id="newRoleDescription" name="newRoleDescription"/>
              <span class="invalid-feedback" id="error-newRoleDescription" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" id="btnCreateUserRole" name="btnCreateUserRole" class="btn btn-outline-primary" onclick="create_role()">Create</button>
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
          <form id="formEditRole">
            <div class="form-group">
              <label for="roleName">Role Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-warning" type="button" onclick="InputRoleName_editable();"><i class="fas fa-edit pr-0"></i></button>
                </div>
                <input type="text" class="form-control" id="roleName" onfocusout="InputRoleName_readonly()" disabled/>
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
          <form id="formCreatePermission">
            <div class="form-group">
              <label for="newPermissionName">Permission Name</label>
              <input type="text" class="form-control" name="newPermissionName" id="newPermissionName"/>
              <span class="invalid-feedback" id="error-newPermissionName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newPermissionDescription">Permission Description</label>
              <input type="text" class="form-control" name="newPermissionDescription" id="newPermissionDescription"/>
              <span class="invalid-feedback" id="error-newPermissionDescription" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" id="btnCreatePermission" class="btn btn-outline-primary" onclick="create_permission()">Create</button>
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
          <form id="formEditPermission">
            <div class="form-group">
              <label for="permissionName">Permission Name</label>
              <input type="text" class="form-control" id="permissionName" name="permissionName" />
            </div>
            <div class="form-group">
              <label for="permissionDescription">Permission Description</label>
              <input type="text" class="form-control" id="permissionDescription" name="permissionDescription" />
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
  <!-- CREATE -->
  <div class="modal fade" id="modal-create-subject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreateSubject">
            <div class="form-group">
              <label for="newSubjectCode">Subject Code</label>
              <input type="text" class="form-control" id="newSubjectCode" name="newSubjectCode"/>
              <span class="invalid-feedback" id="error-newSubjectCode" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newSubjectName">Subject Name</label>
              <input type="text" class="form-control" id="newSubjectName" name="newSubjectName">
              <span class="invalid-feedback" id="error-newSubjectName" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" id="btnCreateSubject" class="btn btn-outline-primary" onclick="create_subject()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->

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
          <form id="formEditSubject">
            <div class="form-group">
              <label for="subjectCode">Subject Code</label>
              <input type="Scode" class="form-control" id="subjectCode" name="subjectCode" aria-describedby="ScodeHelp"/>
              <small id="ScodeHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="subjectName">Subject Name</label>
              <input type="text" class="form-control" id="subjectName" name="subjectName"/>
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
  <!-- CREATE -->
  <div class="modal fade" id="modal-create-exam-type" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Exam Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreateExamType">
            <div class="form-group">
              <label for="newExamTypeName">Exam Type Name</label>
              <input type="text" class="form-control" id="newExamTypeName" name="newExamTypeName"/>
              <span class="invalid-feedback" id="error-newExamTypeName" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnCreateExamType" onclick="create_exam_type()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->
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
          <form id="formEditExamType">
            <div class="form-group">
              <label for="examTypeName">Name</label>
              <input type="Ename" class="form-control" id="examTypeName" name="examTypeName" aria-describedby="ETnameHelp"/>
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

{{-- STUDENT PHASE --}}
  <!-- CREATE -->
  <div class="modal fade" id="modal-create-student-phase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Student Phase</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreatePhase">
            <div class="form-group">
              <label for="newPhaseCode">Phase Code</label>
              <input type="text" class="form-control" id="newPhaseCode" name="newPhaseCode" aria-describedby="NewPhaseCodeHelp"/>
              <small id="NewPhaseCodeHelp" class="form-text text-muted">any help text</small>
              <span class="invalid-feedback" id="error-newPhaseCode" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newPhaseName">Phase Name</label>
              <input type="text" class="form-control" id="newPhaseName" name="newPhaseName" aria-describedby="NewPhaseCodeHelp"/>
              <small id="NewPhaseCodeHelp" class="form-text text-muted">any help text</small>
              <span class="invalid-feedback" id="error-newPhaseName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newPhaseDescription">Phase Description</label>
              <input type="text" class="form-control" name="newPhaseDescription" id="newPhaseDescription" aria-describedby="NewPhaseDescHelp"/>
              <small id="NewPhaseDescHelp" class="form-text text-muted">any help text</small>
              <span class="invalid-feedback" id="error-newPhaseDescription" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" id="btnCreatePhase" class="btn btn-outline-primary" onclick="create_student_phase()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->
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
          <form id="formEditPhase">
            <div class="form-group">
              <label for="phaseCode">Phase Code</label>
              <input type="text" class="form-control" id="phaseCode" name="phaseCode" aria-describedby="PhaseCodeHelp"/>
              <small id="PhaseCodeHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="phaseName">Phase Name</label>
              <input type="text" class="form-control" id="phaseName" name="phaseName" aria-describedby="PhaseNameHelp"/>
              <small id="PhaseNameHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="phaseDescription">Phase Description</label>
              <input type="text" class="form-control" id="phaseDescription" name="phaseDescription" aria-describedby="PhaseDescHelp"/>
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

{{-- PAYMENT METHOD --}}
  <!-- CREATE -->
  <div class="modal fade" id="modal-create-payment-method" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreatePaymentMethod">
            <div class="form-group">
              <label for="newPaymentMethod">Payment Method</label>
              <input type="text" class="form-control" id="newPaymentMethod" name="newPaymentMethod" aria-describedby="NewPaymentMethodHelp"/>
              <small id="NewPaymentMethodHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_payment_method()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->
  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-payment-method" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Online</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditPaymentMethod">
            <div class="form-group">
              <label for="paymentMethod">Payment Method</label>
              <input type="text" class="form-control" id="paymentMethod" name="paymentMethod" aria-describedby="PaymentMethodHelp"/>
              <small id="PaymentMethodHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_payment_method()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{--/ PAYMENT METHOD --}}

{{-- PAYMENT TYPE --}}
  <!-- CREATE -->
  <div class="modal fade" id="modal-create-payment-type" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Payment Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreatePaymentType">
            <div class="form-group">
              <label for="newPaymentType">Payment Type</label>
              <input type="text" class="form-control" id="newPaymentType" name="newPaymentType" aria-describedby="NewPaymentTypeHelp"/>
              <small id="NewPaymentTypeHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_payment_type()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->
  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-payment-type" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Year Registration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditPaymentType">
            <div class="form-group">
              <label for="paymentType">Payment Type</label>
              <input type="text" class="form-control" id="paymentType" name="paymentType" aria-describedby="PaymentTypeHelp"/>
              <small id="PaymentTypeHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="edit_payment_type()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{--/ PAYMENT TYPE --}}
    