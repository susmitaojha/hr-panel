<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->
@include('frontend.common.navbar')
<style>
    .table td,
    .table th {
        vertical-align: middle;
    }

    .table thead th {
        background-color: #f8f9fa;
        text-align: center;
    }

    .highlight-row {
        background-color: #e9ecef;
        font-weight: bold;
    }

    .total-row {
        background-color: #6c757d;
        color: white;
        font-weight: bold;
    }
</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Employee Management</h3>
        </div>
        <section style="background-color: #eee;">
            <div class="container">
                <div class="mb-3">
                    <h5 class="text-center"><strong>CTC Breakup</strong></h5>
                </div>

                <div class="mb-4">
                    <p><strong>NAME:</strong>
                        <span
                            style="font-size: 16px;">{{ $employeeData->fname || $employeeData->mname || $employeeData->lname
                                ? trim("{$employeeData->fname} {$employeeData->mname} {$employeeData->lname}")
                                : 'N/A' }}</span>
                    </p>
                    <p><strong>Employee ID:</strong>
                        <span
                            style="font-size: 16px;">{{ !empty($employeeData->emp_code) ? $employeeData->emp_code : '' }}</span>
                    </p>
                </div>

                <div class="table-responsive">
                    @php
                        $basic = $employeeSalary->basic ?? 0;
                        $hra = $employeeSalary->hra ?? 0;
                        $conv = $employeeSalary->conv_allowance ?? 0;
                        $trans = $employeeSalary->trans_allowance ?? 0;
                        $medical = $employeeSalary->medical_allowance ?? 0;
                        $pf = $employeeSalary->pf_employer ?? 0;
                        $esi = $employeeSalary->esi_employer ?? 0;
                        $other = $employeeSalary->other_benefits ?? 0;

                        $monthlyTotal = $basic + $hra + $conv + $trans + $medical + $pf + $esi + $other;
                        $annualTotal = $monthlyTotal * 12;
                    @endphp

                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>Salary Component</th>
                                <th>Monthly Entitlement (INR)</th>
                                <th>Annualised (INR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Basic Salary</td>
                                <td>{{ $basic }}</td>
                                <td>{{ number_format($basic * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>HRA</td>
                                <td>{{ $hra }}</td>
                                <td>{{ number_format($hra * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Conveyance Allowance</td>
                                <td>{{ $conv }}</td>
                                <td>{{ number_format($conv * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Transport Allowance</td>
                                <td>{{ $trans }}</td>
                                <td>{{ number_format($trans * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Medical Allowance</td>
                                <td>{{ $medical }}</td>
                                <td>{{ number_format($medical * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Provident Fund</td>
                                <td>{{ $pf }}</td>
                                <td>{{ number_format($pf * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>ESI</td>
                                <td>{{ $esi }}</td>
                                <td>{{ number_format($esi * 12, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Other Benefits</td>
                                <td>{{ $other }}</td>
                                <td>{{ number_format($other * 12, 2) }}</td>
                            </tr>
                            <tr class="highlight-row">
                                <td><strong>Gross Salary</strong></td>
                                <td><strong>{{ number_format($monthlyTotal, 2) }}</strong></td>
                                <td><strong>{{ number_format($annualTotal, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="mt-4 border p-3 bg-light">
                    <strong>Performance Periods</strong>
                    <ol class="mt-2 mb-0">
                        <li>January - June</li>
                        <li>July - December</li>
                    </ol>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6 offset-md-6 text-end my-2">
                    <a href="{{ url('employee-salary-stracture/pdf/' . $employeeData->id) }}"><button
                            class="btn btn-primary">Download</button></a>
                </div>
            </div>

        </section>
    </div>
</div>
@include('frontend.common.footer')
