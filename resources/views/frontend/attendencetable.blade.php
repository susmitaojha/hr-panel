
      <!-- Sidebar -->
      @include('frontend.common.sidebar')
      <!-- End Sidebar -->
        
        @include('frontend.common.navbar')

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Attandance And Leave History</h3>
               
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Attendance </a> -->
                <a href="/attendence" class="btn btn-primary btn-round">Add Attendance and Leave</a>
              </div>
            </div>
          
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Attendance List</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col" class="text-end">Status</th>
                            <th scope="col" class="text-end">Entry Time</th>
                            <th scope="col" class="text-end">Exit Time</th>
                            
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col" class="text-end">Status</th>
                            <th scope="col" class="text-end">Entry Time</th>
                            <th scope="col" class="text-end">Exit Time</th>
                            
                          </tr>
                        </tfoot>
                        <tbody>
                        @forelse($data as $item)
                          <tr>
                            <td class="text-end">{{$item->date}}</td>
                            <td>
                            {{$item->employee->fname}} {{$item->employee->mname}} {{$item->employee->lname}}
                            </td>
                            <td class="text-end">
                            @if($item->status == 'Present')
                              <span class="badge badge-success">{{$item->status}}</span>
                            @elseif($item->status == 'Late')
                              <span class="badge badge-secondary">{{$item->status}}</span>
                            @elseif($item->status == 'Half Day')
                              <span class="badge badge-warning">{{$item->status}}</span>
                            @elseif($item->status == 'Absent')
                              <span class="badge badge-danger">{{$item->status}}</span>
                            @elseif($item->status == 'Work Form Home')
                              <span class="badge badge-primary">{{$item->status}}</span>
                            @endif
                            </td>
                            <td class="text-end">{{$item->entry_time}}</td>
                            <td class="text-end">{{$item->exit_time}}
                            </td>
                          </tr>
                          @empty
                          <tr><td colspan="5">No data available</td></tr>
                          @endforelse                      
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                  <div class="card-title">Leave List </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="multi-filter-select-1"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col" class="text-end">Reason</th>
                            
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col" class="text-end">Reason</th>
                            
                          </tr>
                        </tfoot>
                        <tbody>
                        @forelse($holiday as $item)
                          <tr>
                            <td class="text-end">{{$item->date}}</td>
                            <td>
                            {{$item->employee->fname}} {{$item->employee->mname}} {{$item->employee->lname}}
                            </td>
                            <td class="text-end">{{$item->reason}}</td>
                          
                          </tr>
                          @empty
                          <tr><td colspan="5">No data available</td></tr>
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
      