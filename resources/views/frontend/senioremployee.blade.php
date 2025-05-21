
      <!-- Sidebar -->
      @include('frontend.common.sidebar')
      <!-- End Sidebar -->

        
      @include('frontend.common.navbar')
      <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">Senior Employee Records</h3>
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
                <a href="/employee-form" class="btn btn-primary btn-round">Add Employee</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Basic</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Manager Name</th>
                            <th>Salary</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($data as $item)
                          <tr>
                            <td>{{$item->fname}} {{$item->mname}} {{$item->lname}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->gender}}</td>
                            <td>{{$item->manager ? $item->manager->fname .' '. $item->manager->mname .' '. $item->manager->lname : 'No Manager Assigned'}}</td>
                            <td>{{$item->fixedsalary}}</td>
                             <td>
                              <div class="form-button-action">
                              <a
                                  href="{{route('employee.edit',$item->id)}}"
                                  class="btn btn-link btn-primary btn-lg"
                                  data-original-title="Edit Task"
                                >
                                  <i class="fa fa-edit"></i>
                                </a>
                                <button
                                    type="button"
                                    data-id="{{$item->id}}"
                                    class="btn btn-link btn-danger delete-btn"
                                    data-original-title="Remove"
                                    id="alert_demo_3_1"
                                  >
                                    <i class="fa fa-times"></i>
                                  </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr><td colspan="7">No data available</td></tr>
                          @endforelse
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
      