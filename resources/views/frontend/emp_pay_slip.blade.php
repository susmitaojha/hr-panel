<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->
@include('frontend.common.navbar')
<style>
    .salary-header {
        background-color: #0d6efd;
        color: white;
        padding: 1rem;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .summary-box {
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 1rem;
        background: #f8f9fa;
    }
</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Employee Management</h3>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <section>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add monthly bonus</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/bonus-store') }}" method="post" id="add-bonus"
                        enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
                        @csrf
                        <input type="hidden" name="emp_id" value="{{ !empty($emp_id) ? $emp_id : 0 }}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="month" class="form-label">Select Month</label>
                                @php
                                    $months = [];
                                    $start = strtotime(date('Y-m-01', strtotime('-1 year'))); // Start: Jan of last year
                                    $end = strtotime(date('Y-12-01')); // End: Dec of current year

                                    while ($start <= $end) {
                                        $value = date('Y-m', $start); // e.g., 2024-03
                                        $label = date('F Y', $start); // e.g., March 2024
                                        $months[$value] = $label;
                                        $start = strtotime('+1 month', $start);
                                    }
                                @endphp

                                <select name="month" class="form-select form-control">
                                    <option value="" hidden> Choice Option....</option>
                                    @foreach ($months as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="bonus_amount" class="form-label">Bonus Amount</label>
                                <input type="number" step="0.01" class="form-control" id="bonus_amount"
                                    name="bonus_amount" placeholder="Bonus Amount">
                            </div>
                            <div class="col-md-4 md-3">
                                <label for="bonus_frequency" class="form-label">Bonus Frequency</label>
                                <input type="text" class="form-control" id="bonus_frequency"
                                    name="bonus_frequency" value = "monthly">
                                {{-- <select name="bonus_frequency" class="form-select form-control">
                                    <option value="" hidden> Choice Option....</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="halfyearly">Half-Yearly</option>
                                    <option value="yearly">Yearly</option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-primary w-100">Submit Bonus</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"> monthly Bonus Check</div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="emp_id" value="{{ !empty($emp_id) ? $emp_id : 0 }}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="month" class="form-label">Select Month</label>
                                @php
                                    $months = [];
                                    $start = strtotime(date('Y-m-01', strtotime('-1 year'))); // Start: Jan of last year
                                    $end = strtotime(date('Y-12-01')); // End: Dec of current year

                                    while ($start <= $end) {
                                        $value = date('Y-m', $start); // e.g., 2024-03
                                        $label = date('F Y', $start); // e.g., March 2024
                                        $months[$value] = $label;
                                        $start = strtotime('+1 month', $start);
                                    }
                                @endphp
                                <select name="bonus_month" id = "bonus_month" class="form-select form-control">
                                    <option value="" hidden> Choice Option....</option>
                                    @foreach ($months as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-primary mt-3" id = "check_bonus">Check
                                    Bonus</button>
                            </div>
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-primary mt-3" id="download_payslip_btn">Download
                                    Payslip</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="bonus_payslip_container"></div>


            </div>
        </section>
    </div>
</div>
@include('frontend.common.footer')

<script>
    document.getElementById('add-bonus').addEventListener('submit', function(e) {
        let isValid = true;
        let messages = [];

        function checkRequired(name, label) {
            const field = document.querySelector(`[name="${name}"]`);
            if (!field || !field.value || field.value.trim() === '' || field.value === 'Choice Option....') {
                isValid = false;
                messages.push(`${label} is required.`);
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        }

        checkRequired('month', 'Month');
        checkRequired('bonus_amount', 'Bonus Amount');
        checkRequired('bonus_frequency', 'Bonus Frequency');

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: messages.join('<br>'),
            });
        }
    });

    $(document).ready(function() {
        $('#check_bonus').click(function() {
            let emp_id = $('input[name="emp_id"]').val();
            let month = $('select[name="bonus_month"]').val();
            if (!month) {
                Swal.fire({
                    icon: 'error',
                    title: 'Please select a month.',
                });
                return;
            }

            $.ajax({
                url: "{{ url('/fetch-employee-bonus') }}", // Define this route in your web.php
                type: "GET",
                data: {
                    emp_id: emp_id,
                    month: month
                },
                success: function(response) {
                    $('#bonus_payslip_container').html(response);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong. Please try again.',
                    });
                }
            });
        });

        $('#download_payslip_btn').click(function() {
            const empId = $('input[name="emp_id"]').val();
            const selectedMonth = $('#bonus_month').val();

            if (!selectedMonth) {
                Swal.fire({
                    icon: 'error',
                    title: 'Please select a month before downloading the payslip.',
                });
                return;
            }

            const downloadUrl = `{{ url('employee-pay-slip-pdf') }}/${empId}?month=${selectedMonth}`;
            window.open(downloadUrl, '_blank');
        });

    });
</script>
