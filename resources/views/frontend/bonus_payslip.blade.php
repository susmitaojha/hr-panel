<style>
    /* body {
  font-family: Arial, sans-serif;
  padding: 20px;
  background-color: #fff;
} */

    .payslip {
        max-width: 800px;
        margin: auto;
        border: 1px solid #000;
        padding: 20px;
        background-color: #fff;
    }

    h2,
    h3 {
        text-align: center;
        margin: 0;
    }

    .details-table,
    .salary-table,
    .summary-table,
    .final-salary {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .salary-table th,
    .salary-table td,
    .details-table td,
    .summary-table td,
    .final-salary td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .salary-table th {
        background-color: #f0f0f0;
    }

    .final-salary td {
        font-weight: bold;
    }
</style>

<body>
    <div class="payslip">
        <h2>Digital PR World</h2>
        <hr>
        <h3>Pay Slip for {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h3>

        <table class="details-table">
            <tr>
                <td><strong>Employee Name</strong> :
                    {{ $employeeData->fname || $employeeData->mname || $employeeData->lname
                        ? trim("{$employeeData->fname} {$employeeData->mname} {$employeeData->lname}")
                        : 'N/A' }}
                    ({{ !empty($employeeData->emp_code) ? $employeeData->emp_code : '' }})</td>
            </tr>
            <tr>
                <td><strong>Designation : </strong>
                    @php
                        $roles = [
                            '1' => 'Manager',
                            '2' => 'Team Lead',
                            '3' => 'Senior Employee',
                            '4' => 'Junior Employee',
                            '5' => 'HR',
                        ];
                    @endphp

                    {{ !empty($employeeData->role) && isset($roles[$employeeData->role]) ? $roles[$employeeData->role] : '' }}
                </td>
            </tr>
            <tr>
                <td><strong>Department</strong> :
                    {{ !empty($employeeData->department) ? $employeeData->department : '' }}</td>
            </tr>
            <tr>
                <td><strong>Month</strong> : {{ \Carbon\Carbon::parse($month)->format('F Y') }}</td>
            </tr>
        </table>
        @php
            $basic = $employeeSalary->basic ?? 0;
            $hra = $employeeSalary->hra ?? 0;
            $conv = $employeeSalary->conv_allowance ?? 0;
            $trans = $employeeSalary->trans_allowance ?? 0;
            $medical = $employeeSalary->medical_allowance ?? 0;
            $pf = $employeeSalary->pf_employer ?? 0;
            $esi = $employeeSalary->esi_employer ?? 0;
            $other = $employeeSalary->other_benefits ?? 0;
            $bonusAmount = $bonus->bonus_amount ?? 0;

            $earningsTotal = $basic + $hra + $conv + $trans + $medical + $other + $bonusAmount;
            $deductionsTotal = $pf + $esi;
            $netPay = $earningsTotal - $deductionsTotal;
        @endphp

        <table class="salary-table">
            <thead>
                <tr>
                    <th colspan="2">Earnings</th>
                    <th colspan="2">Deductions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Salary head</td>
                    <td>Amount</td>
                    <td>Salary head</td>
                    <td>Amount</td>
                </tr>
                <tr>
                    <td>Basic</td>
                    <td>{{ $basic }}</td>
                    <td>PF Employee</td>
                    <td>{{ $pf ?: 'NA' }}</td>
                </tr>
                <tr>
                    <td>H R A</td>
                    <td>{{ $hra }}</td>
                    <td>ESI Employee</td>
                    <td>{{ $esi ?: 'NA' }}</td>
                </tr>
                <tr>
                    <td>Conv. All</td>
                    <td>{{ $conv }}</td>
                    <td>Loan</td>
                    <td>NA</td>
                </tr>
                <tr>
                    <td>Trans. All</td>
                    <td>{{ $trans }}</td>
                    <td>Tax</td>
                    <td>NA</td>
                </tr>
                <tr>
                    <td>Others</td>
                    <td>{{ $other + $bonusAmount }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Medical Allowance</td>
                    <td>{{ $medical ?: 'NA' }}</td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <td><strong>SALARY (GROSS) / PM</strong></td>
                <td></td>
            </tr>
            <tr>
                <td>PF Employer</td>
                <td>{{ $pf ?: 'NA' }}</td>
            </tr>
            <tr>
                <td>ESI Employer</td>
                <td>{{ $esi ?: 'NA' }}</td>
            </tr>
            <tr>
                <td>Medical</td>
                <td>{{ $medical ?: 'NA' }}</td>
            </tr>
            <tr>
                <td>Telephone</td>
                <td>NA</td>
            </tr>
            <tr>
                <td>Others</td>
                <td>{{ $other ?: 'NA' }}</td>
            </tr>
        </table>

        <table class="final-salary">
            <tr>
                <td><strong>Salary</strong></td>
                <td>{{ number_format($netPay) }} Nett.</td>
                <td><strong>Total Deduction</strong></td>
                <td>{{ $deductionsTotal ?: 'NA' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>



{{-- <style>
    .pay_card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }

    .salary-header {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .col-half {
        flex: 0 0 50%;
        padding: 0 10px;
        box-sizing: border-box;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th,
    td {
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: center;
    }

    thead {
        background-color: #f1f1f1;
    }

    .table-danger {
        background-color: #f8d7da;
    }

    .summary-box {
        background-color: #f7f7f7;
        padding: 15px;
        border-radius: 6px;
        margin-top: 20px;
    }

    .text-end {
        text-align: right;
    }

    .btn {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        margin-top: 20px;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    h4,
    h5,
    h6 {
        margin: 10px 0;
    }

    p {
        margin: 5px 0;
    }
</style>


<div class="pay_card">
    <div class="salary-header">
        <h4 class="mb-0">Pay Slip - {{ $employeeData->fname || $employeeData->mname || $employeeData->lname
                ? trim("{$employeeData->fname} {$employeeData->mname} {$employeeData->lname}")
                : 'N/A' }} ({{ !empty($employeeData->emp_code) ? $employeeData->emp_code : '' }})</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-half">
                @php
                    $roles = [
                        '1' => 'Manager',
                        '2' => 'Team Lead',
                        '3' => 'Senior Employee',
                        '4' => 'Junior Employee',
                        '5' => 'HR',
                    ];
                @endphp
                <p><strong>Designation:</strong> {{ !empty($employeeData->role) && isset($roles[$employeeData->role]) ? $roles[$employeeData->role] : '' }}</p>
                <p><strong>Department:</strong>  {{ !empty($employeeData->department) ? $employeeData->department : '' }}</p>
            </div>
            <div class="col-half">
                <p><strong>Pay Period:</strong>  {{ \Carbon\Carbon::parse($month)->format('F Y') }}</p>
            </div>
        </div>
        @php
            $basic = $employeeSalary->basic ?? 0;
            $hra = $employeeSalary->hra ?? 0;
            $conv = $employeeSalary->conv_allowance ?? 0;
            $trans = $employeeSalary->trans_allowance ?? 0;
            $medical = $employeeSalary->medical_allowance ?? 0;
            $pf = $employeeSalary->pf_employer ?? 0;
            $esi = $employeeSalary->esi_employer ?? 0;
            $other = $employeeSalary->other_benefits ?? 0;
            $bonusAmount = $bonus->bonus_amount ?? 0;

            $earningsTotal = $basic + $hra + $conv + $trans + $medical + $other + $bonusAmount;
            $deductionsTotal = $pf + $esi;
            $netPay = $earningsTotal - $deductionsTotal;
        @endphp
        <h5 class="mb-3">Earnings & Deductions</h5>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Earnings -->
                    <tr>
                        <td>Basic Salary</td>
                        <td>Earning</td>
                        <td>{{ number_format($basic) }}</td>
                    </tr>
                    <tr>
                        <td>HRA</td>
                        <td>Earning</td>
                        <td>{{ number_format($hra) }}</td>
                    </tr>
                    <tr>
                        <td>Conveyance Allowance</td>
                        <td>Earning</td>
                        <td>{{ number_format($conv) }}</td>
                    </tr>
                    <tr>
                        <td>Transport Allowance</td>
                        <td>Earning</td>
                        <td>{{ number_format($trans) }}</td>
                    </tr>
                    <tr>
                        <td>Medical Allowance</td>
                        <td>Earning</td>
                        <td>{{ number_format($medical) }}</td>
                    </tr>
                    <tr>
                        <td>Other Benefits</td>
                        <td>Earning</td>
                        <td>{{ number_format($other) }}</td>
                    </tr>

                    <!-- Deductions -->
                    <tr class="table-danger">
                        <td>PF Employer</td>
                        <td>Deduction</td>
                        <td>{{ number_format($pf) }}</td>
                    </tr>
                    <tr class="table-danger">
                        <td>ESI Employer</td>
                        <td>Deduction</td>
                        <td>{{ number_format($esi) }}</td>
                    </tr>
                    <tr class="table-danger">
                        <td>Bonus</td>
                        <td>Earning</td>
                        <td>{{ number_format($bonusAmount) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-half">
                <div class="summary-box">
                    <h6>Summary</h6>
                    <p><strong>Gross Earnings:</strong> ₹{{ number_format($earningsTotal) }}</p>
                    <p><strong>Total Deductions:</strong> ₹{{ number_format($deductionsTotal) }}</p>
                    <p><strong>Net Pay:</strong> ₹{{ number_format($netPay) }}</p>
                </div>
            </div>
        </div>
    </div>
</div> --}}
