     <!-- Sidebar -->
     @include('frontend.common.sidebar')
     <!-- End Sidebar -->
     @include('frontend.common.navbar')
@php use Carbon\Carbon; @endphp
     <div class="container">
         <div class="page-inner">
             <div class="page-header">
                 <h3 class="fw-bold mb-3">Employee Records</h3>
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
                     <a href="/add-edit-employee/0" class="btn btn-primary btn-round">Add Employee</a>
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
                                            <th>Employee Code</th>
                                             <th>Employee Name</th>
                                             <th>Email</th>
                                             <th>Gender</th>
                                             <th>state</th>
                                             <th>Manager</th>
                                             <th>Joining Date</th>
                                             <th>Actions</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         @if ($data->isNotEmpty())
                                             @foreach ($data as $item)
                                                 <tr>
                                                    <td>{{ $item->emp_code }}</td>
                                                    <td>{{ $item->fname }} {{ $item->mname }} {{ $item->lname }}</td>
                                                     <td>{{ $item->email }}</td>
                                                     <td>{{ $item->gender }}</td>
                                                     <td>
                                                         @if ($item->state == '1')
                                                             Manager
                                                         @elseif ($item->state == '2')
                                                             Team Lead
                                                         @elseif ($item->state == '3')
                                                             Senior Employee
                                                         @elseif ($item->state == '4')
                                                             Junior Employee
                                                         @elseif ($item->state == '5')
                                                             HR
                                                         @else
                                                             No state Assign
                                                         @endif

                                                     </td>
                                                     <td>
                                                         {{ $item->manager
                                                             ? $item->manager->fname . ' ' . $item->manager->mname . ' ' . $item->manager->lname
                                                             : 'No Manager Assigned' }}
                                                     </td>
                                                     <td>{{ Carbon::parse($item->joining_date)->format('d-m-Y') }}</td>
                                                     <td>
                                                         <div class="d-flex align-items-center gap-2">
                                                            <a href="{{ url('employee-details/' . $item->id) }}"
                                                                 class="btn btn-link p-0"
                                                                 data-original-title="Edit Task">
                                                                 <i class="fa fa-eye"></i>
                                                             </a>
                                                             <a href="{{ url('add-edit-employee/' . $item->id) }}"
                                                                 class="btn btn-link p-0"
                                                                 data-original-title="Edit Task">
                                                                 <i class="fa fa-edit"></i>
                                                             </a>
                                                             <a href="{{ url('delete-employee/' . $item->id) }}"
                                                                 onclick="return handleDelete(event, this)"
                                                                 class="btn btn-link p-0" title="Delete Employee"><i
                                                                     class="fa-solid fa-trash text-danger"></i></a>
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
         $(document).ready(function() {
             $('#employee-datatables').DataTable({

                 pageLength: 25, // Show 25 entries by default
                 dom: 'lBfrtip',
                 order: ['6', 'desc'],
                 buttons: [{
                         extend: 'excelHtml5',
                         text: 'Export to Excel',
                         className: 'btn-excel',
                         exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5]
                         }
                     },
                     {
                         extend: 'pdfHtml5',
                         text: 'Export to PDF',
                         className: 'btn-pdf',
                         exportOptions: {
                             columns: [0, 1, 2, 3, 4, 5]
                         }
                     }
                 ]
             });
         });
     </script>
