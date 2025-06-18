     <!-- Sidebar -->
     @include('frontend.common.sidebar')
     <!-- End Sidebar -->
     @include('frontend.common.navbar')

     <div class="container">
         <div class="page-inner">
             <div class="page-header">
                 <h3 class="fw-bold mb-3">Project Records</h3>
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
                         <a href="#">Tables</a>
                     </li>
                     <li class="separator">
                         <i class="icon-arrow-right"></i>
                     </li>
                 </ul>
                 <div class="ms-md-auto py-2 py-md-0">
                     <a href="/add-edit-project/0" class="btn btn-primary btn-round">Add Project</a>
                 </div>
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
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Basic</h4>
                         </div>
                         <div class="card-body">

                             <div class="table-responsive">
                                 <table id="employee-datatables" class="display table table-striped table-hover">
                                     <thead>
                                         <tr>
                                            <th style="display: none;">ID</th>
                                             <th>Project Code</th>
                                             <th>Project Name</th>
                                             <th>Manager Name</th>
                                             <th>Team Lead Name</th>
                                             <th>Priority</th>
                                             <th>Status</th>
                                             <th>Start Date</th>
                                             <th>End Date</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @if ($data->isNotEmpty())
                                         @foreach ($data as $project)
                                         <tr>
                                            <td style="display: none;">{{ $project->id }}</td>
                                             <td>{{ $project->p_code }}</td>
                                             <td>{{ $project->pname }}</td>
                                             <td>{{ $project->manager?->full_name ?? 'N/A' }}</td>
                                             <td>{{ $project->teamLead?->full_name ?? 'N/A' }}</td>
                                             <td>{{ $project->priority }}</td>
                                            <td>
                                                @if(strtolower($project->status) == 'closed')
                                                    <span class="badge bg-danger">{{ $project->status }}</span>
                                                @elseif(strtolower($project->status) == 'running')
                                                    <span class="badge bg-success">{{ $project->status }}</span>
                                                @elseif(strtolower($project->status) == 'pending')
                                                    <span class="badge bg-warning text-dark">{{ $project->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $project->status }}</span> {{-- default --}}
                                                @endif
                                            </td>
                                             <td>{{ $project->start_date }}</td>
                                             <td>{{ $project->end_date }}</td>
                                             <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ url('add-edit-project/'.$project->id) }}"
                                                       class="btn btn-link p-0"
                                                       title="Edit Project">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </a>
                                                    <a href="{{ url('assign-project/'.$project->id) }}"
                                                        class="btn btn-link p-0"
                                                        title="Edit Project">
                                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                                     </a>
                                                    <a href="{{ url('delete-project/' . $project->id) }}"
                                                       onclick="return handleDelete(event, this)"
                                                       class="btn btn-link p-0"
                                                       title="Delete Project">
                                                        <i class="fa-solid fa-trash text-danger"></i>
                                                    </a>
                                                </div>
                                             </td>
                                         </tr>
                                     @endforeach
                                         @else
                                             <tr>
                                                 <td colspan="6">No data available</td>
                                             </tr>
                                         @endif
                                     </tbody>

                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>


     @include('frontend.common.footer')
<script>
    $(document).ready(function () {
        $('#employee-datatables').DataTable({
        pageLength: 25, // Show 25 entries by default
        dom: 'lBfrtip',
        order: ['0', 'desc'],
        buttons: [
            {
            extend: 'excelHtml5',
            text: 'Export to Excel',
            className: 'btn-excel',
            exportOptions: {
                columns: [0, 1, 2, 3, 4,5,6.7]
                }
            },
            {
            extend: 'pdfHtml5',
            text: 'Export to PDF',
            className: 'btn-pdf',
            exportOptions: {
                columns: [0, 1, 2, 3, 4,5,6,7]
                }
            }
        ]
        });
    });
</script>
