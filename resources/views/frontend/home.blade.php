<!-- Sidebar -->
@include('frontend.common.sidebar')
<!-- End Sidebar -->
@include('frontend.common.navbar')

<style>
    .card-title {
        font-size: 1rem;
    }

    .chart-container {
        height: 300px;
        width: 100%;
    }
</style>

<div class="container">
    <div class="page-inner">
        <div class="container-fluid p-3">
            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold">HRMS Admin Dashboard</h2>
                <p class="text-muted">Overview of employee projects</p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Employees</h5>
                            <h3 class="fw-bold">145</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Active Projects</h5>
                            <h3 class="fw-bold">12</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Departments</h5>
                            <h3 class="fw-bold">7</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Progress Chart -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Project Completion Status</h5>
                    <div class="chart-container">
                        <canvas id="projectChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('frontend.common.footer')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart.js Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('projectChart').getContext('2d');
        const projectChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Project A', 'Project B', 'Project C', 'Project D', 'Project E'],
                datasets: [{
                    label: '% Completed',
                    data: [85, 60, 40, 90, 70],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>

