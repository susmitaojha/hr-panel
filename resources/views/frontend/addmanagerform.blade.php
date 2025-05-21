
      <!-- Sidebar -->
      @include('frontend.common.sidebar')
      <!-- End Sidebar -->

        
        @include('frontend.common.navbar')
        <div class="container">
          <div class="page-inner">
            <div class="page-header">
               
              <h3 class="fw-bold mb-3">Forms</h3>
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
                  <a href="#">Forms</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Basic Form</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
              @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Onboarding Employee</div>
                  </div>
                  <form action="/add-manager" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input
                                type="text"
                                name="fname"
                                class="form-control"
                                id=""
                                placeholder="Enter First Name"
                            />
                            </div>

                            <div class="form-group">
                            <label>Email Address</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                id="email"
                                placeholder="Enter Email"
                            />
                            </div>
                            <div class="form-group">
                            <label>Designation</label>
                            <input
                                type="text"
                                name="designation"
                                class="form-control"
                                id=""
                                placeholder="Enter Designation"
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Middle Name</label>
                            <input
                                type="text"
                                name="mname"
                                class="form-control"
                                id=""
                                placeholder="Enter Middle Name"
                            />
                            </div>
                            <div class="form-group">
                            <label>Gender</label><br />
                            <div class="d-flex">
                                <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    value="Male"
                                    id="flexRadioDefault1"
                                />
                                <label
                                    class="form-check-label"
                                    for="flexRadioDefault1"
                                >
                                    Male
                                </label>
                                </div>
                                <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    value="Female"
                                    name="gender"
                                    id="flexRadioDefault2"
                                    checked
                                />
                                <label
                                    class="form-check-label"
                                    for="flexRadioDefault2"
                                >
                                    Female
                                </label>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="exampleFormControlSelect1"
                                >Role</label
                            >
                            <select
                                class="form-select"
                                id="exampleFormControlSelect1"
                                name="role"
                            >
                                <option value="manger">Manager</option>
                                <option value="teamlead">Team Lead</option>
                                <option value="senior">Senior Employee</option>
                                <option value="junior">Junior Employee</option>
                            </select>
                            </div>
                    
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Last Name</label>
                            <input
                                type="text"
                                name="lname"
                                class="form-control"
                                id=""
                                placeholder="Enter Last Name"
                            />
                            </div>
                            <div class="form-group">
                            <label>Skills</label>
                            <textarea
                                class="form-control"
                                name="skills"
                                aria-label="With textarea"
                                ></textarea>                        
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="card-title">Performance Points</div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    
                        <div class="card">
                        <div class="card-body">         
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                    <th>Table heading</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Managment</th>
                                    <td> <input
                                        type="number"
                                        class="form-control"
                                        name="inc-1"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td> <input
                                        type="number"
                                        class="form-control"
                                        name="inc-2"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-3"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-4"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-5"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-6"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td>100</td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="total"
                                        placeholder="0"
                                        readonly
                                    /></td>
                                </tr>
                                <tr>
                                    <th>Execution</th>
                                    <td> <input
                                        type="number"
                                        class="form-control"
                                        name="inc-1"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td> <input
                                        type="number"
                                        class="form-control"
                                        name="inc-2"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-3"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-4"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-5"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="inc-6"
                                        placeholder="0"
                                        onchange="IncrementCal(this)"
                                    /></td>
                                    <td>100</td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        name="total"
                                        placeholder="0"
                                        readonly
                                    /></td>
                                </tr>
                                <tr>
                                    
                                    <td colspan = "8" style="text-align:right">
                                        <button type="button" class="btn btn-success" id="markBtn">Total Mark</button>
                                    </td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        id="avg"
                                        placeholder="0"
                                        readonly
                                    /></td>
                                </tr>
                                <tr>
                                    <td colspan = "8" style="text-align:right">
                                    <button type="button" class="btn btn-danger text-end" id="addBtn">Add to Salary Form</button>
                                    </td>
                                    <td><input
                                        type="number"
                                        class="form-control"
                                        id="mark"
                                        placeholder="0"
                                    /></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-action">
                       
                    </div>
           
            </div>
                    <div class="card-header">
                        <div class="card-title">Salary Details</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label >Basic</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-1"
                                placeholder="0"
                              
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>HRA</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-2"
                                placeholder="0"
                              
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Conv. All</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-3"
                                placeholder="0"
                               
                            />
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Trans. All</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-4"
                                placeholder="0"
                              
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Others</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-5"
                                placeholder="0"
                             
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Medical Allowance</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-6"
                                placeholder="0"
                              
                            />
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>PF Employer</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-7"
                                placeholder="0"
                               
                            />
                            </div>
                            <div class="form-group">
                            <label>Bonus</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-8"
                                placeholder="0"
                             
                            />
                            </div>
                           
                        </div>
                        <div class="col-md-6 col-lg-4">
                            
                            <div class="form-group">
                            <label>ESI Employer</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-9"
                                placeholder="0"
            
                            />
                            </div>
                          
                            <div class="form-group">
                            <label>Other Benefits</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-10"
                                placeholder="0"
                        
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">                         
                        <div class="form-group">
                            <label>Telephone</label>
                            <input
                                type="number"
                                class="form-control salary"
                                id="sal-11"
                                placeholder="0"
                              
                            />
                            </div>
                            <div class="form-group">
                            <label for="variablePay"></label>
                                <button type="button" class="btn btn-success" id="calculateBtn">Calculate</button>
                                <button type="button" class="btn btn-danger" id="downloadBtn">Download</button>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-4 col-lg-4">                         
                     
                            <div class="form-group">
                            <label>Salary(Nett.)</label>
                            <input
                                type="number"
                                class="form-control"
                                id="resultField"
                                placeholder="0"
                                readonly
                            />
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">                         
                     
                            <div class="form-group">
                            <label>Increment(%)</label>
                            <input
                                type="number"
                                class="form-control"
                                id="increment"
                                placeholder="0"
                                readonly
                            />
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">                         
                            <div class="form-group">
                            <label>Salary</label>
                            <input
                                type="number"
                                class="form-control"
                                id="incrementSalary"
                                placeholder="0"
                                name="fixedsalary"
                                readonly
                            />
                            </div>
                        </div>
                        </div>
                        
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
     
<footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
             <div class="copyright">
              &2024 - 
              <a href="#">Copywrite</a>
            </div>
          </div>
        </footer>
        </div>

  
</div>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Kaiadmin JS -->
<script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js')}}"></script>
<script>
    $('#calculateBtn').on('click', function( ) {
        let sum = 0;
        $('.salary').each(function() {
            sum += parseFloat($(this).val()) || 0; 
        })
        $('#resultField').val(sum) ;
        $('#incrementSalary').val(sum) ;

        let passMark = document.getElementById("mark").value
        let besic =  document.getElementById("sal-1").value
        if(passMark > 0){
            let increment = document.getElementById("increment").value 
            let afterIncrement = 0 
            let finalSalary = 0
            afterIncrement = (besic * increment) / 100
            finalSalary = sum + afterIncrement
            document.getElementById("incrementSalary").value = finalSalary;
        }    
    })
</script>
<script>
    $('#downloadBtn').on('click', function( ) {
      const sal1 = $('#sal-1').val() || 0;
      const sal2 = $('#sal-2').val() || 0;
      const sal3 = $('#sal-3').val() || 0;
      const sal4 = $('#sal-4').val() || 0;
      const sal5 = $('#sal-5').val() || 0;
      const sal6 = $('#sal-6').val() || 0;
      const sal7 = $('#sal-7').val() || 0;
      const sal8 = $('#sal-8').val() || 0;
      const sal9 = $('#sal-9').val() || 0;
      const sal10 = $('#sal-10').val() || 0;
      const sal11 = $('#sal-11').val() || 0;
      const resultField = $('#incrementSalary').val();

      const {jsPDF} = window.jspdf;
      const doc = new jsPDF();

      doc.text('---------------------Salary details---------------', 10,10);
      doc.text(`Basic:${sal1}`, 10,20);
      doc.text(`HRA:${sal2}`, 10,30);
      doc.text(`Conv. All:${sal3}`, 10,40);
      doc.text(`Trans. All:${sal4}`, 10,50);
      doc.text(`Others:${sal5}`, 10,60);
      doc.text(`Medical Allowance:${sal6}`, 10,70);
      doc.text(`PF Employer:${sal7}`, 10,80);
      doc.text(`ESI Employer:${sal8}`, 10,90);
      doc.text(`Telephone:${sal9}`, 10,100);
      doc.text(`Bonus:${sal10}`, 10,110);
      doc.text(`Other Benefits:${sal11}`, 10,120);
      doc.text(`Salary:${resultField}`, 10,130);

      doc.save('paySlip.pdf')
    })
</script>
<script>
    function IncrementCal(v){
        var index = $(v).parent().parent().index();
        var inc1 = document.getElementsByName("inc-1")[index].value;
        var inc2 = document.getElementsByName("inc-2")[index].value;
        var inc3 = document.getElementsByName("inc-3")[index].value;
        var inc4 = document.getElementsByName("inc-4")[index].value;
        var inc5 = document.getElementsByName("inc-5")[index].value;
        var inc6 = document.getElementsByName("inc-6")[index].value;

        var total = 0
        total = +(inc1) + +(inc2) + +(inc3) + +(inc4) + +(inc5) + +(inc6);
        document.getElementsByName("total")[index].value = total;
    }
</script>
<script>
    function IncrementTotal(v){
        var index = $(v).parent().parent().index();
        var inc1 = document.getElementsByName("inc-1")[index].value;
        var inc2 = document.getElementsByName("inc-2")[index].value;
        var inc3 = document.getElementsByName("inc-3")[index].value;
        var inc4 = document.getElementsByName("inc-4")[index].value;
        var inc5 = document.getElementsByName("inc-5")[index].value;
        var inc6 = document.getElementsByName("inc-6")[index].value;

        var total = 0
        total = +(inc1) + +(inc2) + +(inc3) + +(inc4) + +(inc5) + +(inc6);
        document.getElementsByName("total")[index].value = total;
    }
    $('#markBtn').on('click', function( ) {
        var avarage = 0;
        var totals = document.getElementsByName("total")

        for(let index=0; index<totals.length; index++){
            var total = totals[index].value;
            avarage = +(avarage) + +(total)
        }
        document.getElementById("avg").value = Math.floor(avarage);
    })

    $('#addBtn').on('click', function( ) {
        var mark = document.getElementById("mark").value
        document.getElementById("increment").value = mark;
    })
</script>
</body>
</html>

      