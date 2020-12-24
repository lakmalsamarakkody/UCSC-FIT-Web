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
              <label for="inputNewRoleName">Role Name</label>
              <input type="text" class="form-control" id="inputNewRoleName" name="inputNewRoleName"/>
            </div>
            <div class="form-group">
              <label for="inputNewRoleDescription">Role Description</label>
              <input type="text" class="form-control" id="inputNewRoleDescription" name="inputNewRoleDescription"/>
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
          <form>
            <div class="form-group">
              <label for="InputRoleName">Name</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-warning" type="button" onclick="InputRoleName_editable();"><i class="fas fa-edit pr-0"></i></button>
                </div>
                <input type="text" class="form-control" id="InputRoleName" onfocusout="InputRoleName_readonly()" disabled/>
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
              <input type="text" class="form-control" id="InputPermissionName" />
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
          <form>
            <div class="form-group">
              <label for="InputNewSubjectCode">Subject Code</label>
              <input type="text" class="form-control" id="InputNewSubjectCode"/>
            </div>
            <div class="form-group">
              <label for="InputNewSubjectName">Subject Name</label>
              <input type="text" class="form-control" id="InputNewSubjectName"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_subject()">Create</button>
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
          <form>
            <div class="form-group">
              <label for="InputNewExamTypeName">Exam Type Name</label>
              <input type="text" class="form-control" id="InputNewExamTypeName"/>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_exam_type()">Create</button>
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
  <!-- CREATE -->
  <div class="modal fade" id="modal-create-academic-year" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" data-backdrop="static" data-keyboard="false" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Academic Year</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="InputNewYear">Year</label>
              <select class="form-control" id="InputNewYear">
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
              </select>
              <small id="YearHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="InputNewYearStart">Start</label>
                <input type="date" class="form-control" id="InputNewYearStart"/>
              </div>
              <div class="form-group col-md-6">
                <label for="InputNewYearEnd">End</label>
                <input type="date" class="form-control" id="InputNewYearEnd"/>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_academic_year()">Create</button>
        </div>
      </div>
    </div>
  </div>
  <!--/ CREATE -->
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
          <form>
            <div class="form-group">
              <label for="InputNewPhaseCode">Code</label>
              <input type="text" class="form-control" id="InputNewPhaseCode" aria-describedby="NewPhaseCodeHelp"/>
              <small id="NewPhaseCodeHelp" class="form-text text-muted">any help text</small>
            </div>
            <div class="form-group">
              <label for="InputNewPhaseDescription">Description</label>
              <input type="text" class="form-control" id="InputNewPhaseDescription" aria-describedby="NewPhaseDescHelp"/>
              <small id="NewPhaseDescHelp" class="form-text text-muted">any help text</small>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
          <button type="button" class="btn btn-outline-primary" onclick="create_student_phase()">Create</button>
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
          <form>
            <div class="form-group">
              <label for="InputNewPaymentMethod">Payment Method</label>
              <input type="text" class="form-control" id="InputNewPaymentMethod" aria-describedby="NewPaymentMethodHelp"/>
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
          <form>
            <div class="form-group">
              <label for="InputPaymentMethod">Payment Method</label>
              <input type="text" class="form-control" id="InputPaymentMethod" aria-describedby="PaymentMethodHelp"/>
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
          <form>
            <div class="form-group">
              <label for="InputNewPaymentType">Payment Type</label>
              <input type="text" class="form-control" id="InputNewPaymentType" aria-describedby="NewPaymentTypeHelp"/>
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
          <form>
            <div class="form-group">
              <label for="InputPaymentType">Payment Type</label>
              <input type="text" class="form-control" id="InputPaymentType" aria-describedby="PaymentTypeHelp"/>
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
    