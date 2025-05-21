<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->


@include('frontend.common.navbar')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Project</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Project Assign Form</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Assign Employees to Project</div>
                    </div>
                    <form action="/post-assign-employees" method="POST" id="projectassignForm">
                        @csrf
                            <div class="card p-4 shadow-sm rounded-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <input type="hidden" class="form-control" id="projectId" name="projectId" value="{{ $project->id }}">
                                    <input type="text" class="form-control" id="projectName" name="projectName" value="{{ $project->pname }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="projectName" class="form-label">Project Manager</label>
                                    <input type="text" class="form-control" id="projectName" name="projectName" value="{{ $project->manager?->full_name ?? '' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="projectName" class="form-label">Team Lead Name</label>
                                    <input type="text" class="form-control" id="projectName" name="projectName" value="{{ $project->teamLead?->full_name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                @if($assignEmployees->isNotEmpty())
                                <label class="form-label mt-3">Select Employees</label>
                                <div class="row">
                                    @foreach($assignEmployees as $employee)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    value="{{ $employee->id }}"
                                                    id="emp{{ $employee->id }}"
                                                    name="employees[]"
                                                    @if(in_array($employee->id, $assignedEmployeeIds)) checked @endif>
                                                <label class="form-check-label" for="emp{{ $employee->id }}">
                                                    {{ $employee->full_name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No employees assigned under this team lead.</p>
                            @endif

                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Assign to Project</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.common.footer')

<script>
    document.getElementById('projectForm').addEventListener('submit', function (e) {
        let isValid = true;
        let messages = [];

        // Helper function to check if a field is empty
        function checkRequired(id, label) {
            const field = document.getElementById(id);
            if (!field.value.trim()) {
                isValid = false;
                messages.push(`${label} is required.`);
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        }

        // Validate required text/number fields
        checkRequired('pname', 'Project Name');
        checkRequired('hours', 'Estimated Hours');
        checkRequired('priority', 'Priority');
        checkRequired('managerid', 'Manager');
        checkRequired('team_lead_id', 'Team Lead');
        checkRequired('start_date', 'Start Date');
        checkRequired('end_date', 'End Date');
        checkRequired('status', 'Status');

        // Validate that start_date is before end_date
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
            isValid = false;
            messages.push("End Date must be after Start Date.");
            document.getElementById('end_date').classList.add('is-invalid');
        } else {
            document.getElementById('end_date').classList.remove('is-invalid');
        }

        // If not valid, prevent submission and show alert
        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: messages.join('<br>'),
            });
        }
    });
</script>

</body>

</html>
