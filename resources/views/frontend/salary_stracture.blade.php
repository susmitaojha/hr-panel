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
            <div class="container my-5">
                <div class="mb-3">
                    <h5 class="text-center"><strong>CTC Breakup</strong></h5>
                </div>

                <div class="mb-4">
                    <p><strong>NAME:</strong> <em>Susmita Ojha</em></p>
                    <p><strong>GRADE:</strong> <em>E1</em></p>
                </div>

                <div class="table-responsive">
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
                                <td>11,000.00</td>
                                <td>132,000.00</td>
                            </tr>
                            <tr>
                                <td>HRA</td>
                                <td>5,500.00</td>
                                <td>66,000.00</td>
                            </tr>
                            <tr>
                                <td>Transport Allowance</td>
                                <td>800.00</td>
                                <td>9,600.00</td>
                            </tr>
                            <tr>
                                <td>Medical Allowance</td>
                                <td>1,250.00</td>
                                <td>15,000.00</td>
                            </tr>
                            <tr>
                                <td>Monthly Performance Pay</td>
                                <td>3,450.00</td>
                                <td>41,400.00</td>
                            </tr>
                            <tr class="highlight-row">
                                <td>Gross Salary</td>
                                <td>22,000.00</td>
                                <td>264,000.00</td>
                            </tr>
                            <tr>
                                <td>Other Benefits</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Health Insurance</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr class="total-row">
                                <td>Total Gross</td>
                                <td>22,000.00</td>
                                <td>264,000.00</td>
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
        </section>
    </div>
</div>
@include('frontend.common.footer')
