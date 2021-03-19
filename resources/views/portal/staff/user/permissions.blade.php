@extends('layouts.portal')

@section('content')
  <script type="text/javascript">
    // ACTIVE NAVIGATION ENTRY
    $(document).ready(function ($) {
        $('#users').addClass("active");
    });
  </script>

  {{-- BREACRUMB --}}
  <section class="col-sm-12 mb-3">
      <div class="row">
          
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/portal/staff/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/portal/staff/users') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
          </ol>
        </nav>

      </div>
  </section>
  {{-- /BREACRUMB --}}

  {{-- CONTENT --}}
  <div class="col-lg-12 userPermissions min-vh-100">
    <div class="row">

      {{-- ACCESS AREA --}}
      <div class="col-12">

        {{-- SELECT USER ROLE CARD --}}
        <div class="card userRoleList">
          <form id="formUserRole" method="GET">
            <div class="card-header">User Role</div>
            <div class="card-body">
              {{-- USER ROLE DROPDOWN LIST --}}
              <select name="selectUserRole" id="selectUserRole" class="form-control">
                <option value="" disabled hidden selected>- SELECT USER ROLE -</option>
                @foreach ($roles as $role)
                  @if (old('selectUserRole') == $role->id)
                    <option value="{{ $role->id}}" selected>{{ $role->name}}</option>
                  @else
                    <option value="{{ $role->id}}">{{ $role->name}}</option>
                  @endif
                @endforeach
              </select>
              {{-- /USER ROLE DROPDOWN LIST --}}
            </div>
            {{-- <div class="card-footer"><button type="submit" class="btn btn-primary">Select</button></div> --}}
          </form>
        </div>
        {{-- /SELECT USER ROLE CARD --}}

        @if($modules)

        {{-- PERMISSIONS LIST CARD --}}
        <div class="card mt-3 userRolePermssionList">
          <div class="card-header">Permissions ( {{ $portal ?? 'none' }} Portal )</div>
          <div class="card-body">

            {{-- MODULE LIST ACCORDIAN --}}
            <div class="accordian" id="permissionModulesAccordian">
              @foreach ($modules as $module)
                <div class="card">
                  <div class="card-header" id="module{{$module->module}}">
                    <button class="btn btn-block text-primary text-left" type="button" data-toggle="collapse" data-target="#collapse{{$module->module}}" aria-expanded="true" aria-controls="collapseOne">
                      <span class="text-uppercase font-weight-bold"> {{$module->module}} MODULE </span>
                    </button>
                  </div>
                  <div id="collapse{{$module->module}}" class="collapse" aria-labelledby="headingOne" data-parent="#permissionModulesAccordian">
                    <hr class="w-100 mt-0"/>
                    <div class="card-body">
                      <div class="col-12">
                        <div class="row">
                          @foreach (App\Models\User\Permission::where('portal', $portal)->where('module', $module->module)->get() as $permission)
                          <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="form-group form-check">
                              <label class="switch">
                                <input type="checkbox" id="inputCheck{{ $permission->id }}" class="form-check-input" name="{{ $permission->id }}" value="{{ $permission->id }}" onclick="permissionStatusChanger({{ $permission->id }})" @if(App\Models\User\Role\hasPermission::where('role_id', $selectedUserRole)->where('permission_id', $permission->id)->first()) checked @endif/>
                                <span class="slider round"></span>
                              </label>
                              <label class="form-check-label">{{ $permission->id }} {{ $permission->name }} </label>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            {{-- MODULE LIST ACCORDIAN --}}

          </div>
          <div class="card-footer"></div>
        </div>
        {{-- PERMISSIONS LIST CARD --}}

        @endif

      </div>
      {{-- /ACCESS AREA --}}
    </div>
  </div>
  {{-- CONTENT --}}
@endsection

@section('script')
  @include('portal.staff.user.permissions.scripts')
@endsection