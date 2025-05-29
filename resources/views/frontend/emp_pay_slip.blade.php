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
        <section style="background-color: #eee;">

            <div class="container py-5">
                <div class="card shadow">
                    <div class="salary-header">
                        <h4 class="mb-0">Salary Structure - John Doe (EMP12345)</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-4 row">
                            <div class="col-md-6">
                                <p><strong>Designation:</strong> Senior Developer</p>
                                <p><strong>Department:</strong> IT</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Pay Period:</strong> May 2025</p>
                                <p><strong>Bank Account:</strong> ****5678</p>
                            </div>
                        </div>

                        <h5 class="mb-3">Earnings & Deductions</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
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
                                        <td>40,000</td>
                                    </tr>
                                    <tr>
                                        <td>HRA</td>
                                        <td>Earning</td>
                                        <td>15,000</td>
                                    </tr>
                                    <tr>
                                        <td>Conveyance Allowance</td>
                                        <td>Earning</td>
                                        <td>5,000</td>
                                    </tr>
                                    <!-- Deductions -->
                                    <tr class="table-danger">
                                        <td>Professional Tax</td>
                                        <td>Deduction</td>
                                        <td>200</td>
                                    </tr>
                                    <tr class="table-danger">
                                        <td>PF Contribution</td>
                                        <td>Deduction</td>
                                        <td>1,800</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="summary-box">
                                    <h6>Summary</h6>
                                    <p><strong>Gross Earnings:</strong> ₹60,000</p>
                                    <p><strong>Total Deductions:</strong> ₹2,000</p>
                                    <p><strong>Net Pay:</strong> ₹58,000</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-primary mt-3">Download Payslip</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('frontend.common.footer')
