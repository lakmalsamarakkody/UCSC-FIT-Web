@extends('layouts.portal')

@section('content')

  <script type="text/javascript">

    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#system').addClass("active");
    });

  </script>

  <!-- BREACRUMB -->
  <section class="col-sm-12 mb-3">
      <div class="row">
          
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">System</li>
          </ol>
        </nav>

      </div>
  </section>
  <!-- /BREACRUMB -->

  <!-- CONTENT -->
  <div class="col-md-12 system">
    <div class="row">
      <!-- PERMISSION -->
      @if(Auth::user()->hasPermission('staff-system-permission'))
      <div class="col-12">
        <div class="card">
          <div class="card-header">PERMISSIONS</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md permissions-yajradt">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Portal</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody id="permissionsTblBody">

                </tbody>
                {{-- @foreach ($permissions as $permission)
                <tr id="tbl-permission-tr-{{$permission->id}}">
                  <td>{{ $permission->id }}</td>
                  <td>{{ $permission->name }}</td>
                  <td>{{ $permission->portal }}</td>
                  <td>{{ $permission->module }}</td>
                  <td>{{ $permission->description }}</td>
                  <td class="text-right">
                    <div class="btn-group">
                      @if(Auth::user()->hasPermission('staff-system-permission-edit'))<button type="button" class="btn btn-outline-warning" id="btnEditPermission-{{$permission->id}}" onclick="edit_permission_modal_invoke({{ $permission->id }});"><i class="fas fa-edit"></i></button>@endif
                      @if(Auth::user()->hasPermission('staff-system-permission-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeletePermission-{{$permission->id}}" onclick="delete_permission({{ $permission->id }});"><i class="fas fa-trash-alt"></i></button>@endif
                    </div>
                  </td>
                </tr>
                @endforeach --}}
                {{-- </thead> --}}
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-permission-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-permission"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /PERMISSION -->

      <!-- USER ROLE -->
      @if(Auth::user()->hasPermission('staff-system-role'))
      <div class="col-xl-5 col-lg-12 mt-xl-5">
        <div class="card">
          <div class="card-header">USER ROLE</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <thead>
                  @foreach ($roles as $role)
                  <tr id="tbl-userRole-tr-{{$role->id}}">
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td class="text-right">
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-system-role-view'))<button type="button" class="btn btn-outline-success" id="btnViewUserRole-{{$role->id}}" onclick="view_role_modal_invoke({{$role->id}});"><i class="fas fa-eye"></i> <span id="spinnerBtnViewUserRole-{{$role->id}}" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-role-edit'))<button type="button" class="btn btn-outline-warning" id="btnEditUserRole-{{$role->id}}" onclick="edit_role_modal_invoke({{$role->id}});"><i class="fas fa-edit"></i> <span id="spinnerBtnEditUserRole-{{$role->id}}" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-role-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeleteUserRole-{{$role->id}}" onclick="delete_role({{$role->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-role-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-role"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /USER ROLE -->

      <!-- SUBJECT -->
      @if(Auth::user()->hasPermission('staff-system-subject'))
      <div class="col-xl-6 col-lg-12 mt-xl-5">
        <div class="card">
          <div class="card-header">SUBJECTS</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <thead>
                  @foreach ($subjects as $subject)
                  <tr id="tbl-subject-tr-{{$subject->id}}">
                    <td>{{ $subject->id }}</td>
                    <td><b>FIT{{ $subject->code }}</b></td>
                    <td>{{ $subject->name }}</td>
                    <td class="text-right">
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-system-subject-edit'))<button type="button" class="btn btn-outline-warning" id="btnEditSubject-{{$subject->id}}" onclick="edit_subject_modal_invoke({{$subject->id}});"><i class="fas fa-edit"></i></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-subject-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeleteSubject-{{$subject->id}}" onclick="delete_subject({{$subject->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-subject-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-subject"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /SUBJECT -->

      <!-- EXAM TYPE -->
      @if(Auth::user()->hasPermission('staff-system-examType'))
      <div class="col-xl-6 col-lg-12 mt-xl-5">
        <div class="card">
          <div class="card-header">EXAM TYPES</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Type Name</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <thead>
                  @foreach ($exam_types as $type)
                  <tr id="tbl-examType-tr-{{$type->id}}">
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td class="text-right">
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-system-examType-edit'))<button type="button" class="btn btn-outline-warning" id="bntEditExamType-{{$type->id}}" onclick="edit_exam_type_modal_invoke({{$type->id}});"><i class="fas fa-edit"></i></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-examType-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeleteExamType-{{$type->id}}" onclick="delete_exam_type({{$type->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-examType-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-exam-type"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /EXAM TYPE -->

      <!-- STUDENT PHASES -->
      @if(Auth::user()->hasPermission('staff-system-studentPhase'))
      <div class="col-xl-5 col-lg-12 mt-xl-5">
        <div class="card">
          <div class="card-header">STUDENT PHASES</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <thead>
                  @foreach ($phases as $phase)
                  <tr id="tbl-studentPhase-tr-{{$phase->id}}">
                    <td>{{ $phase->id }}</td>
                    <td>{{ $phase->code }}</td>
                    <td>{{ $phase->name }}</td>
                    <td>{{ $phase->description }}</td>
                    <td class="text-right">
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-system-studentPhase-edit'))<button type="button" class="btn btn-outline-warning" id="btnEditStudentPhase-{{$phase->id}}" onclick="edit_student_phase_modal_invoke({{$phase->id}});"><i class="fas fa-edit"></i></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-studentPhase-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeleteStudentPhase-{{$phase->id}}" onclick="delete_student_phase({{$phase->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-studentPhase-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-student-phase"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /STUDENT PHASES -->

      <!-- PAYMENT METHODS -->
      @if(Auth::user()->hasPermission('staff-system-paymentMethod'))
      <div class="col-xl-6 col-lg-12 mt-xl-5">
        <div class="card">
          <div class="card-header">PAYMENT METHODS</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Method Name</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <thead>
                  @foreach ($payment_methods as $method)
                  <tr id="tbl-paymentMethod-tr-{{$method->id}}">
                    <td>{{ $method->id }}</td>
                    <td>{{ $method->name }}</td>
                    <td class="text-right">
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-system-paymentMethod-edit'))<button type="button" class="btn btn-outline-warning" id="btnEditPaymentMethod-{{$method->id}}" onclick="edit_payment_method_modal_invoke({{$method->id}})"><i class="fas fa-edit"></i></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-paymentMethod-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeletePaymentMethod-{{$method->id}}" onclick="delete_payment_method({{$method->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-paymentMethod-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-payment-method"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /PAYMENT METHODS -->

      <!-- PAYMENT TYPES -->
      @if(Auth::user()->hasPermission('staff-system-paymentType'))
      <div class="col-xl-6 col-lg-12 mt-xl-5">
        <div class="card">
          <div class="card-header">PAYMENT TYPES</div>
          <div class="card-body">
            <div class="card-text">
              <table class="table table-responsive-md">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Type Name</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <thead>
                  @foreach ($payment_types as $type)
                  <tr id="tbl-paymentType-tr-{{$type->id}}">
                    <th>{{ $type->id }}</th>
                    <td>{{ $type->name }}</td>
                    <td class="text-right">
                      <div class="btn-group">
                        @if(Auth::user()->hasPermission('staff-system-paymentType-edit'))<button type="button" class="btn btn-outline-warning" id="btnEditPaymentType-{{$type->id}}" onclick="edit_payment_type_modal_invoke({{$type->id}});"><i class="fas fa-edit"></i></button>@endif
                        @if(Auth::user()->hasPermission('staff-system-paymentType-delete'))<button type="button" class="btn btn-outline-danger" id="btnDeletePaymentType-{{$type->id}}" onclick="delete_payment_type({{$type->id}});"><i class="fas fa-trash-alt"></i></button>@endif
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </thead>
              </table>
            </div>
          </div>
          @if(Auth::user()->hasPermission('staff-system-paymentType-add'))
          <div class="card-footer"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-create-payment-type"><i class="fas fa-plus"></i></button></div>
          @endif
        </div>
      </div>
      @endif
      <!-- /PAYMENT TYPES -->

      @include('portal.staff.system.modal')
    
    </div>
  </div>
  <!-- /CONTENT -->

  @include('portal.staff.system.scripts')

@endsection
