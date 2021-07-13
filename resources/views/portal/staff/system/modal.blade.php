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
              <label for="newPortalName">Portal Name</label>
              <select class="form-control" name="newPortalName" id="newPortalName" onchange="onchange_portal();">
                <option value="" selected hidden>Select the Portal</option>
                <option value="staff">Staff</option>
                <option value="student">Student</option>
              </select>
              <span class="invalid-feedback" id="error-newPortalName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newPermissionModule">Permission Module</label>
              <select class="form-control" name="newPermissionModule" id="newPermissionModule">
                <option value="" selected hidden>Select Permission Module</option>
              </select>
              <span class="invalid-feedback" id="error-newPermissionModule" role="alert"></span>
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
          <h5 class="modal-title" id="modal-edit-permission-title">Permission Title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditPermission">
            <div class="form-group">
              <label for="permissionName">Permission Name</label>
              <input type="hidden" class="form-control" id="permissionID" name="permissionID" />
              <span class="invalid-feedback" id="error-permissionID" role="alert"></span>
              <input type="text" class="form-control" id="permissionName" name="permissionName" disabled/>
              <span class="invalid-feedback" id="error-permissionName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="portalName">Portal Name</label>
              <select class="form-control" name="portalName" id="portalName" onchange="onchange_portal();">
                <option value="" hidden selected>Select the Portal</option>
                <option value="staff">Staff</option>
                <option value="student">Student</option>
              </select>
              <span class="invalid-feedback" id="error-portalName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="permissionModule">Permission Module</label>
              <select class="form-control" name="permissionModule" id="permissionModule">
                <option value="" hidden selected>Select Permission Module</option>
              </select>
              <span class="invalid-feedback" id="error-permissionModule" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="permissionDescription">Permission Description</label>
              <input type="text" class="form-control" id="permissionDescription" name="permissionDescription" />
              <span class="invalid-feedback" id="error-permissionDescription" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditPermission" onclick="edit_permission()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->

{{-- /PERMISSION --}}

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
          <h5 class="modal-title" id="modal-view-role-title">System Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Permission List</h5>
          <div class="container-fluid">
            <div id="permissionList" class="row">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ VIEW -->

  <!-- EDIT -->
  <div class="modal fade" id="modal-edit-role" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-edit-role-title">Role Title</h5>
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
                <input type="text" class="form-control" name="roleNameEdit" id="roleNameEdit" onfocusout="InputRoleName_readonly()" disabled/>
              </div>
            </div>
          
            <p class="mt-5">Permission List</p>

            <div class="container-fluid">
              <div class="row" id="permissionListEdit">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnEditUserRolePermissions">Update <span id="spinnerBtnEditUserRolePermissions" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->

{{-- /USER ROLE --}}

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
          <h5 class="modal-title" id="modal_edit_subject_title">Subject Title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditSubject">
            <div class="form-group">
              <label for="subjectCode">Subject Code</label>
              <input type="hidden" class="form-control" id="subjectId" name="subjectId" />
              <span class="invalid-feedback" id="error-subjectId" role="alert"></span>
              <input type="Scode" class="form-control" id="subjectCode" name="subjectCode" />
              <span class="invalid-feedback" id="error-subjectCode" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="subjectName">Subject Name</label>
              <input type="text" class="form-control" id="subjectName" name="subjectName"/>
              <span class="invalid-feedback" id="error-subjectName" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditSubject"onclick="edit_subject()">Update</button>
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
          <h5 class="modal-title" id="modal-edit-exam-type-title">Exam type title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditExamType">
            <div class="form-group">
              <label for="examTypeName">Name</label>
              <input type="hidden" class="form-control" id="examTypeId" name="examTypeId" />
              <span class="invalid-feedback" id="error-examTypeId" role="alert"></span>
              <input type="Ename" class="form-control" id="examTypeName" name="examTypeName" />
              <span class="invalid-feedback" id="error-examTypeName" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditExamType" onclick="edit_exam_type()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{-- /EXAM TYPE --}}

{{-- EXAM DURATION --}}
  {{-- CREATE --}}
  <div class="modal fade" id="modal-create-exam-duration" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Set Exam Duration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreateExamDuration">
            <div class="row">
              <div class="form-group col-xl-6">
                <label for="newExamDurationSubject">Subject Name</label>
                <select class="form-control" name="newExamDurationSubject" id="newExamDurationSubject">
                  <option value="" selected hidden>Select Subject</option>
                  @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" id="error-newExamDurationSubject" role="alert"></span>
              </div>
              <div class="form-group col-xl-6">
                <label for="newExamDurationExamType">Exam Type</label>
                <select class="form-control" name="newExamDurationExamType" id="newExamDurationExamType">
                  <option value="" selected hidden>Select Exam Type</option>
                  @foreach ($exam_types as $type)
                      <option value="{{ $type->id }}">{{ $type->name }}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" id="error-newExamDurationExamType" role="alert"></span>
              </div>
              <div class="form-group col-xl-6">
                <label for="newExamDurationHours">Duration(Hours)</label>
                <input type="number" id="newExamDurationHours" class="form-control" placeholder="hours" min="0" max="12" />
                <span class="invalid-feedback" id="error-newExamDurationHours" role="alert"></span>
              </div>
              <div class="form-group col-xl-6">
                <label for="newExamDurationMinutes">Duration(Minutes)</label>
                <input type="number" id="newExamDurationMinutes" class="form-control" placeholder="minutes" min="0" max="59" />
                <span class="invalid-feedback" id="error-newExamDurationMinutes" role="alert"></span>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" id="btnCreateExamDuration" class="btn btn-outline-primary" onclick="set_exam_duration();">Create</button>
        </div>
      </div>
    </div>
  </div>
  {{-- / CREATE --}}
{{-- / EXAM DURATION --}}

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
              <input type="text" class="form-control" id="newPhaseCode" name="newPhaseCode" />
              <span class="invalid-feedback" id="error-newPhaseCode" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newPhaseName">Phase Name</label>
              <input type="text" class="form-control" id="newPhaseName" name="newPhaseName" />
              <span class="invalid-feedback" id="error-newPhaseName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newPhaseDescription">Phase Description</label>
              <input type="text" class="form-control" name="newPhaseDescription" id="newPhaseDescription" />
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
          <h5 class="modal-title" id="modal-edit-student-phase-title">Phase 1 - Fresh User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditStudentPhase">
            <div class="form-group">
              <label for="phaseCode">Phase Code</label>
              <input type="hidden" class="form-control" name="phaseId" id="phaseId">
              <span class="invalid-feedback" id="error-phaseId" role="alert"></span>
              <input type="text" class="form-control" id="phaseCode" name="phaseCode" />
              <span class="invalid-feedback" id="error-phaseCode" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="phaseName">Phase Name</label>
              <input type="text" class="form-control" id="phaseName" name="phaseName" />
              <span class="invalid-feedback" id="error-phaseName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="phaseDescription">Phase Description</label>
              <input type="text" class="form-control" id="phaseDescription" name="phaseDescription" />
              <span class="invalid-feedback" id="error-phaseDescription" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditStudentPhase" onclick="edit_student_phase()">Update</button>
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
              <input type="text" class="form-control" id="newPaymentMethod" name="newPaymentMethod" />
              <span class="invalid-feedback" id="error-newPaymentMethod" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnCreatePaymentMethod" onclick="create_payment_method()">Create</button>
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
          <h5 class="modal-title" id="modal-edit-payment-method-title">Online</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditPaymentMethod">
            <div class="form-group">
              <label for="paymentMethodName">Payment Method</label>
              <input type="hidden" class="form-control" id="paymentMethodId" name="paymentMethodId" />
              <span class="invalid-feedback" id="error-paymentMethodId" role="alert"></span>
              <input type="text" class="form-control" id="paymentMethodName" name="paymentMethodName" />
              <span class="invalid-feedback" id="error-paymentMethodName" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditPaymentMethod" onclick="edit_payment_method()">Update</button>
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
              <input type="text" class="form-control" id="newPaymentType" name="newPaymentType" />
              <span class="invalid-feedback" id="error-newPaymentType" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnCreatePaymentType" onclick="create_payment_type()">Create</button>
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
          <h5 class="modal-title" id="modal-edit-payment-type-title">Payment Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditPaymentType">
            <div class="form-group">
              <label for="paymentTypeName">Payment Type</label>
              <input type="hidden" class="form-control" name="paymentTypeId" id="paymentTypeId">
              <span class="invalid-feedback" id="error-paymentTypeId" role="alert"></span>
              <input type="text" class="form-control" id="paymentTypeName" name="paymentTypeName" />
              <span class="invalid-feedback" id="error-paymentTypeName" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditPaymentType" onclick="edit_payment_type()">Update</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ EDIT -->
{{--/ PAYMENT TYPE --}}

{{-- LAB --}}
  {{-- CREATE --}}
  <div class="modal fade" id="modal-create-lab" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Lab</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formCreateLab">
            <div class="form-group">
              <label for="newLabName">Lab Name</label>
              <input type="text" class="form-control" id="newLabName" name="newLabName" />
              <span class="invalid-feedback" id="error-newLabName" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newLabCapacity">Lab Capacity</label>
              <input type="text" class="form-control" id="newLabCapacity" name="newLabCapacity" />
              <span class="invalid-feedback" id="error-newLabCapacity" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="newLabStatus">Lab Status</label>
              <select name="newLabStatus" id="newLabStatus" class="form-control">
                <option value="" selected hidden>Please Select Status</option>
                <option value="Active">Active</option>
                <option value="Deactive">Deactive</option>
              </select>
              <span class="invalid-feedback" id="error-newLabStatus" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnCreateLab" onclick="create_lab();">Create</button>
        </div>
      </div>
    </div>
  </div>
  {{-- / CREATE --}}

  {{-- EDIT --}}
  <div class="modal fade" id="modal-edit-lab" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Lab</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditLab">
            <div class="form-group">
              <label for="labCapacity">Lab Capacity</label>
              <input type="hidden" class="form-control" id="labId" name="labId">
              <span class="invalid-feedback" id="error-labId" role="alert"></span>
              <input type="text" class="form-control" id="labCapacity" name="labCapacity" />
              <span class="invalid-feedback" id="error-labCapacity" role="alert"></span>
            </div>
            <div class="form-group">
              <label for="labStatus">Lab Status</label>
              <select name="labStatus" id="labStatus" class="form-control">
                <option value="" selected hidden>Please Select Status</option>
                <option value="Active">Active</option>
                <option value="Deactive">Deactive</option>
              </select>
              <span class="invalid-feedback" id="error-labStatus" role="alert"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" id="btnModalEditLab" onclick="edit_lab();">Update</button>
        </div>
      </div>

    </div>

  </div>
  {{-- / EDIT --}}
{{-- / LAB --}}

{{-- IMPORT STUDENTS --}}
<div class="modal fade" id="importStudents" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticimportStudents" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="staticimportStudents">Import Students</h5>
              <button type="butoon" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="class-body p-5">
              <div class="alert alert-danger">Student data in selected file will be merged to your existing production database.</div>
              <form id="studentImportForm">
                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="studentFile">Student Import File</label>
                    <div class="drop-zone">
                      <span class="drop-zone__prompt">Drop Students File here or click to upload</span>
                      <input type="file" name="studentImportFile" id="studentImportFile" class="drop-zone__input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
                    </div>
                      <span id="errorStudentFile" class="invalid-feedback" role="alert"></span>
                  </div>
                </div>
              </form>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
              <button id="importTempStudent" onclick="import_student()" type="button" class="btn btn-outline-primary">
                Import
                <span id="importTempStudentSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              </button>
          </div>
      </div>
  </div>
</div>
{{-- /IMPORT STUDENTS --}}
    