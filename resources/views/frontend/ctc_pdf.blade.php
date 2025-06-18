<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CTC Breakup</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            background-color: #fff;
        }

        h3, h5 {
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        thead th {
            background-color: #f8f9fa;
        }

        .highlight-row {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .section {
            margin: 20px 0;
        }

        .info {
            margin: 10px 0;
        }

        .performance {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f4f4f4;
        }

        .download-button {
            display: none;
        }
    </style>
</head>
<body>
    <h3>Employee Salary Stracture</h3>
    <h5><strong>CTC Breakup</strong></h5>
    <div class="section info">
        <p><strong>NAME:</strong>
            <span>
                {{ $employeeData->fname || $employeeData->mname || $employeeData->lname
                    ? trim("{$employeeData->fname} {$employeeData->mname} {$employeeData->lname}")
                    : 'N/A' }}
            </span>
        </p>
        <p><strong>Employee ID:</strong>
            <span>{{ !empty($employeeData->emp_code) ? $employeeData->emp_code : '' }}</span>
        </p>
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

        $monthlyTotal = $basic + $hra + $conv + $trans + $medical + $pf + $esi + $other;
        $annualTotal = $monthlyTotal * 12;
    @endphp
    <table>
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

    <div class="section performance">
        <strong>Performance Periods:</strong>
        <ol>
            <li>January - June</li>
            <li>July - December</li>
        </ol>
    </div>

</body>
</html>
