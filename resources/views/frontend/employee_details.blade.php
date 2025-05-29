@php
    use Carbon\Carbon;
@endphp
<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->
@include('frontend.common.navbar')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Employee Management</h3>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ $employeeData->emp_photo ? asset('assets/employee_photos/' . $employeeData->emp_photo) : asset('assets/default_user.png') }}"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">
                                    {{ $employeeData->fname || $employeeData->mname || $employeeData->lname
                                        ? trim("{$employeeData->fname} {$employeeData->mname} {$employeeData->lname}")
                                        : 'N/A' }}
                                </h5>
                                <p class="text-muted mb-4">
                                    Employee ID: {{ !empty($employeeData->emp_code) ? $employeeData->emp_code : '' }}
                                </p>
                                @php
                                    $roles = [
                                        '1' => 'Manager',
                                        '2' => 'Team Lead',
                                        '3' => 'Senior Employee',
                                        '4' => 'Junior Employee',
                                        '5' => 'HR',
                                    ];
                                @endphp
                                <p class="text-muted mb-1">
                                    {{ !empty($employeeData->role) && isset($roles[$employeeData->role]) ? $roles[$employeeData->role] : '' }}
                                </p>
                                <p class="text-muted mb-4">
                                    {{ !empty($employeeData->department) ? $employeeData->department : '' }}</p>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="{{ url('employee-pay-slip/' . $employeeData->id) }}" target="_blank"
                                        title="employee salary stracture"><button type="button" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary">Pay
                                        slip</button></a>
                                    <a href="{{ url('employee-salary-stracture/' . $employeeData->id) }}" target="_blank"
                                        title="employee salary stracture"><button type="button" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-outline-primary ms-1">Salary
                                            Structure</button></a>
                                </div>
                            </div>
                        </div>
                        @if (!empty($employeeImage))
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <p class="mb-4 p-3">
                                        Employee Documents
                                    </p>
                                    <ul class="list-group list-group-flush rounded-3">
                                        @foreach ($employeeImage as $empImagerow)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fas fa-globe fa-lg text-warning"></i>
                                                <a href="{{ asset('assets/employee_documents/' . $empImagerow->emp_document) }}"
                                                    target="_blank">
                                                    <p class="mb-0">View Document </p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ $employeeData->fname || $employeeData->mname || $employeeData->lname
                                                ? trim("{$employeeData->fname} {$employeeData->mname} {$employeeData->lname}")
                                                : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ !empty($employeeData->email) ? $employeeData->email : '' }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Mobile</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ !empty($employeeData->contact_no) ? $employeeData->contact_no : '' }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Date of birth</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ $employeeData->dob ? Carbon::parse($employeeData->dob)->format('d-m-Y') : '' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Date of birth</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ !empty($employeeData->gender) ? $employeeData->gender : '' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Manager Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ $employeeData->manager?->fullname ?? 'No Manager Assigned' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Team leader</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ $employeeData->manager?->fullname ?? 'No Manager Assigned' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Joining Date</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ $employeeData->joining_date ? Carbon::parse($employeeData->joining_date)->format('d-m-Y') : '' }}
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            {{ collect([
                                                $employeeData->address_line1,
                                                $employeeData->address_line2,
                                                $employeeData->city,
                                                $employeeData->district,
                                                $employeeData->state,
                                                $employeeData->pincode,
                                            ])->filter()->implode(', ') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span>
                                            Project Status
                                        </p>
                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 72%"
                                                aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 89%"
                                                aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 55%"
                                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                        <div class="progress rounded mb-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 66%"
                                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4 mb-md-0">
                                    <div class="card-body">
                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span>
                                            Project Status
                                        </p>
                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 72%"
                                                aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 89%"
                                                aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                        <div class="progress rounded" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 55%"
                                                aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                        <div class="progress rounded mb-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 66%"
                                                aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('frontend.common.footer')
