@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/dashboard-animations.css') }}">

<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-header">
                    <h1>
                        <i class="uil-chart-line"></i>
                        Dashboard
                    </h1>
                    <p class="dashboard-subtitle">
                        <i class="uil-calendar-alt me-1"></i>
                        {{ now()->format('l, F j, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Key Statistics Cards -->
        <div class="row mb-4">
            <!-- Total Trips Card -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-truck"></i>
                    </div>
                    <div class="stat-card-title">Total Trips</div>
                    <div class="stat-card-value">1,248</div>
                    <div class="stat-card-change positive">
                        <i class="uil-arrow-up"></i>
                        <span>12.5% from last month</span>
                    </div>
                </div>
            </div>

            <!-- Active Drivers Card -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-user-check"></i>
                    </div>
                    <div class="stat-card-title">Active Drivers</div>
                    <div class="stat-card-value">42</div>
                    <div class="stat-card-change positive">
                        <i class="uil-arrow-up"></i>
                        <span>8.3% increase</span>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-rupee"></i>
                    </div>
                    <div class="stat-card-title">Total Revenue</div>
                    <div class="stat-card-value">₹12.5L</div>
                    <div class="stat-card-change positive">
                        <i class="uil-arrow-up"></i>
                        <span>15.2% growth</span>
                    </div>
                </div>
            </div>

            <!-- Pending Orders Card -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-hourglass"></i>
                    </div>
                    <div class="stat-card-title">Pending Orders</div>
                    <div class="stat-card-value">23</div>
                    <div class="stat-card-change negative">
                        <i class="uil-arrow-down"></i>
                        <span>3.2% decrease</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <!-- Trips Over Time Chart -->
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="uil-chart-area me-2"></i>
                            Trips Over Time
                        </h5>
                        <div class="chart-actions">
                            <button class="chart-action-btn">Week</button>
                            <button class="chart-action-btn active">Month</button>
                            <button class="chart-action-btn">Year</button>
                        </div>
                    </div>
                    <canvas id="tripsChart" height="80"></canvas>
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="col-lg-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="uil-pie-chart me-2"></i>
                            Status Distribution
                        </h5>
                    </div>
                    <canvas id="statusChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="activity-card">
                    <h5 class="section-title mb-3">
                        <i class="uil-history"></i>
                        Recent Trips
                    </h5>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="uil-truck"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Trip #T-2024-001 Completed</p>
                            <p class="activity-time">2 hours ago • Delhi to Mumbai</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="uil-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Trip #T-2024-002 In Progress</p>
                            <p class="activity-time">30 minutes ago • Bangalore to Chennai</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="uil-alert-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Trip #T-2024-003 Pending</p>
                            <p class="activity-time">1 hour ago • Hyderabad to Pune</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="uil-check-double"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Trip #T-2024-004 Completed</p>
                            <p class="activity-time">3 hours ago • Kolkata to Delhi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Drivers -->
            <div class="col-lg-6">
                <div class="activity-card">
                    <h5 class="section-title mb-3">
                        <i class="uil-crown"></i>
                        Top Performers
                    </h5>
                    
                    <div class="activity-item">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #166534, #1a7d3a); color: white;">
                            <i class="uil-trophy"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Rajesh Kumar</p>
                            <p class="activity-time">12 trips completed this month</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
                            <i class="uil-star"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Priya Sharma</p>
                            <p class="activity-time">10 trips completed this month</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
                            <i class="uil-heart"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Amit Patel</p>
                            <p class="activity-time">8 trips completed this month</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;">
                            <i class="uil-award"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Neha Singh</p>
                            <p class="activity-time">7 trips completed this month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="dashboard-section">
            <h4 class="section-title">
                <i class="uil-flash"></i>
                Quick Actions
            </h4>
            
            <div class="quick-actions">
                <a href="{{ route('trips.create') }}" class="action-button">
                    <i class="uil-plus-circle"></i>
                    <span>New Trip</span>
                </a>
                <a href="{{ route('driver.create') }}" class="action-button">
                    <i class="uil-user-plus"></i>
                    <span>Add Driver</span>
                </a>
                <a href="{{ route('party.create') }}" class="action-button">
                    <i class="uil-users-alt"></i>
                    <span>New Consignor</span>
                </a>
                <a href="{{ route('supplier.create') }}" class="action-button">
                    <i class="uil-store"></i>
                    <span>New Supplier</span>
                </a>
                <a href="{{ route('vehicle.create') }}" class="action-button">
                    <i class="uil-truck-side"></i>
                    <span>New Vehicle</span>
                </a>
                <a href="{{ route('trans.create') }}" class="action-button">
                    <i class="uil-exchange-alt"></i>
                    <span>New Transaction</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Trips Over Time Chart
    const tripsCtx = document.getElementById('tripsChart').getContext('2d');
    const tripsChart = new Chart(tripsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Trips',
                data: [280, 320, 350, 290, 380, 410],
                borderColor: '#166534',
                backgroundColor: 'rgba(22, 101, 52, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#166534',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'In Progress', 'Pending'],
            datasets: [{
                data: [65, 20, 15],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 13,
                            weight: '500'
                        }
                    }
                }
            }
        }
    });
</script>

@endsection