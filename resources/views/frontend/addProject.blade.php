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
                    <a href="#">Project Form</a>
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
                        <div class="card-title">Add Project</div>
                    </div>
                    <form action="/post-add-edit-project" method="post" id="projectForm">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="project_id" value="{{ !empty($project->id) ? $project->id : 0 }}">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="pname" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" id="pname" name="pname" value="{{ !empty($project->pname) ? $project->pname : '' }}">
                                </div>
                                <div class="col">
                                    <label for="hours" class="form-label">Estimated Hours</label>
                                    <input type="number" class="form-control" id="hours" name="hours" value="{{ !empty($project->hours) ? $project->hours : '' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" id="note" name="note" rows="3">{{ !empty($project->note) ? $project->note : '' }}</textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select class="form-control form-select" id="priority" name="priority">
                                        <option value="" hidden>Choice Option</option>
                                        <option value="Low" {{ !empty($project->priority) && $project->priority == 'Low' ? 'selected' : '' }}>Low</option>
                                        <option value="Medium" {{ !empty($project->priority) && $project->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="High" {{ !empty($project->priority) && $project->priority == 'High' ? 'selected' : '' }}>High</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="managerid" class="form-label">Manager ID</label>
                                    <select class="form-control" name="managerid" id = "managerid">
                                        <option value="">Select Manager</option>
                                        @foreach ($mangerdata as $item)
                                            <option value="{{ $item->id }}"
                                                {{ !empty($project->managerid) && $project->managerid == $item->id ? 'selected' : '' }}>
                                                {{ $item->fname }} {{ $item->mname }} {{ $item->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="team_lead_id" class="form-label">Team Lead ID</label>
                                    <select class="form-control" name="team_lead_id" id = "team_lead_id">
                                        <option value="">Select Team Lead</option>
                                        @foreach ($teamleaddata as $teamLeaditem)
                                            <option value="{{ $teamLeaditem->id }}"
                                                {{ !empty($project->team_lead_id) && $project->team_lead_id == $teamLeaditem->id ? 'selected' : '' }}>
                                                {{ $teamLeaditem->fname }} {{ $teamLeaditem->mname }} {{ $teamLeaditem->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ !empty($project->start_date) ? $project->start_date : '' }}">
                                </div>
                                <div class="col">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ !empty($project->end_date) ? $project->end_date : '' }}">
                                </div>
                                <div class="col">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control form-select" id="status" name="status">
                                        <option value="" hidden>Choice Option</option>
                                        <option value="running" {{ !empty($project->status) && $project->status == 'running' ? 'selected' : '' }}>Running</option>
                                        <option value="pending" {{ !empty($project->status) && $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ !empty($project->status) && $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="closed" {{ !empty($project->status) && $project->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type = "submit">Submit</button>
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
        //checkRequired('hours', 'Estimated Hours');
        checkRequired('priority', 'Priority');
        checkRequired('managerid', 'Manager');
        checkRequired('team_lead_id', 'Team Lead');
        checkRequired('start_date', 'Start Date');
        //checkRequired('end_date', 'End Date');
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
