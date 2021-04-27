<!-- STUDENT LIST-->
<div class="modal fade" id="modal-assign-student-list" data-backdrop="static" tabindex="-1" aria-labelledby="modal-assign-student-list-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Students for Exams</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 assignStudentList">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-5">
                                <div class="card-header">Exam Schedule Details</div>
                                <div class="card-body">
                                    <input type="hidden" id="assignScheduleId" value="" class="form-control" readonly>
                                    <table class="table">
                                        <tr>
                                            <th>Subject: </th>
                                            <td><span id="spanAssignSubject"></span></td>
                                        </tr>
                                            <th>Exam Type: </th>
                                            <td><span id="spanAssignExamType"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Scheduled Date: </th>
                                            <td><span id="spanAssignExamDate"></span></td>
                                        </tr>
                                        <tr>
                                            <th>Scheduled Time: </th>
                                            <td><span id="spanAssignExamTime"></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="card mb-5">
                                <div class="card-header">Filters</div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <div class="input-group input-group-md">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="form-control btn btn-outline-secondary" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false"><i class="fa fa-filter"></i>&nbsp;Filter</button>
                                                </div>
                                                <input id="searchAll" type="text" class="form-control" placeholder="Enter search details.."/>
                                                <div class="input-group-append">
                                                    <button type="button" class="form-control btn btn-primary" onclick="search_students();"><i class="fa fa-search"></i>&nbsp;Search</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseFilters">
                                            <div class="card shadow-none">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-xl-3 col-lg-6 col-12">
                                                            <label for="year">Year</label>
                                                            <select id="year" name="year" class="form-control form-control-sm">
                                                                <option value="">select here---</option>
                                                                {{-- @foreach($years as $year)                          
                                                                <option value="{{ $year->year }}">{{ $year->year }}</option>
                                                                @endforeach --}}
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-6 col-12">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control form-control-sm" id="name" aria-describedby="nameHelp"/>
                                                            <small id="nameHelp" class="form-text text-muted">Enter Name Here</small>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-6 col-12">
                                                            <label for="regNo">Reg: No</label>
                                                            <input type="text" class="form-control form-control-sm" id="regNo" aria-describedby="regNoHelp"/>
                                                            <small id="regNoHelp" class="form-text text-muted">Enter Registration Number Here</small>
                                                        </div>
                                                        <div class="form-group col-xl-3 col-lg-6 col-12">
                                                            <label for="nic">NIC</label>
                                                            <input type="text" class="form-control form-control-sm" id="nic" aria-describedby="nicHelp"/>
                                                            <small id="nicHelp" class="form-text text-muted">Enter NIC Here</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>              
                                    </form>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">Student List</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 order-md-1 order-2">
                                            <table class="table tbl-assign-students-yajradt">
                                                <thead>
                                                    <tr>
                                                        <th>Registration No</th>
                                                        <th>Name</th>
                                                        <th>NIC/Postal/Passport</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    @if(Auth::user()->hasPermission("staff-exam-examAssign-assign"))
                                    <div class="mt-4 col-12 text-center">
                                        <div id="divBtnAssignStudents" class="btn-group col-xl-3 mt-1">
                                            <button type="button" class="btn btn-success form-control" id="btnAssignStudents" onclick="assign_students();">Assign Selected Students<span id="spinnerBtnAssignStudents" class="spinner-border spinner-border-sm d-none " role="status" aria-hidden="true"></span></button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Assign Later</button>
            </div>
        </div>
    </div>
</div>
<!-- /STUDENT LIST-->