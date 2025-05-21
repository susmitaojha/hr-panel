
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
                    <div class="card-title">Employee Attendence Form</div>
                  </div>
                  <form action="/attendance-store" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                    >Employee Name</label
                                >
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                    name="employee_id"
                                >
                                    <option >Select Employee</option>
                                    @foreach($data as $item)     
                                        <option value="{{$item->id}}">{{$item->fname}} {{$item->mname}} {{$item->lname}}</option>
                                    @endforeach 
                                </select>
                            </div>

                            <div class="form-group">
                            <label>Exit Time</label>
                            <input
                                type="time"
                                name="exit_time"
                                class="form-control"
                            />
                            </div>
                           
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Date</label>
                            <input
                                type="date"
                                name="date"
                                class="form-control"
                                id=""
                               
                            />
                            </div>
                           
                            <div class="form-group">
                            <label for="exampleFormControlSelect1"
                                >Status</label
                            >
                            <select
                                class="form-control"
                                id="exampleFormControlSelect1"
                                name="status"
                            >
                                <option value="">Select Status</option>
                                <option value="Present">Present</option>
                                <option value="Late">Late</option>
                                <option value="Half Day">Half Day</option>
                                <option value="Absent">Absent</option>
                                <option value="Work Form Home">Work Form Home</option>
                            </select>
                            </div>
                    
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Entry Time</label>
                            <input
                                type="time"
                                name="entry_time"
                                class="form-control"
                                id=""
                               
                            />
                            </div>
                           
                          
                        </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
                @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
                @endif
                    <div class="card-header">
                        <div class="card-title">Traking Holiday</div>
                    </div>
                    <form action="/holiday" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"
                                    >Employee Name</label
                                >
                                <select
                                    class="form-control"
                                    id="exampleFormControlSelect1"
                                    name="employee_id"
                                >
                                    <option >Select Employee</option>
                                    @foreach($data as $item)     
                                        <option value="{{$item->id}}">{{$item->fname}} {{$item->mname}} {{$item->lname}}</option>
                                    @endforeach 
                                </select>
                            </div>                           
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                            <label>Date</label>
                            <input
                                type="date"
                                name="date"
                                class="form-control"
                                id=""
                               
                            />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label>Reason</label>
                                <input
                                    type="text"
                                    name="reason"
                                    class="form-control"
                                    id="sal-7"
                                
                                
                                />
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
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

      