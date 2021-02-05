{{-- NEW USER MODAL --}}
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="newUserForm">
            <div class="form-row">
              <div class="form-group col">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                <span class="invalid-feedback" id="error-userEmail" role="alert"></span>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="inputEmail4">Re-type Email</label>
                <input type="email" class="form-control" id="reTypeEmail" name="reTypeEmail" required>
                <span class="invalid-feedback" id="error-reTypeEmail" role="alert"></span>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="inputEmail4">Role</label>
                <select class="form-control" name="userRole" id="userRole" required>
                  <option value="">Select Role</option>
                  @foreach($roles as $role)                          
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                  @endforeach
                </select>
                <span class="invalid-feedback" id="error-userRole" role="alert"></span>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="add_user()" class="btn btn-primary">Add User</button>
      </div>
    </div>
  </div>
</div>
{{-- NEW USER MODAL --}}
