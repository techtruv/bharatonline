@extends('layouts.app')
@section('body')

<link rel="stylesheet" href="{{ asset('dashboard/assets/css/compact-dashboard.css') }}">

<div class="dashboard-container compact-dashboard">
    <div class="container-fluid">
        <!-- Attractive Dashboard Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-header d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="mb-1">
                            <i class="uil-chart-line me-2"></i>
                            Welcome back, Admin! 👋
                        </h1>
                        <p class="dashboard-subtitle mb-0">
                            <i class="uil-calendar-alt me-1"></i>
                            {{ now()->format('l, F j, Y') }} • Here's what's happening today
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="uil-bell me-1"></i>
                            <span class="notification-badge">3</span>
                            Alerts
                        </button>
                        <button class="btn btn-primary btn-sm">
                            <i class="uil-plus me-1"></i>
                            Quick Add
                        </button>
                    </div>
                </div>

                <!-- Quick Stats Bar -->
                <div class="mt-3 p-3 rounded-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border: 1px solid rgba(102, 126, 234, 0.2);">
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="fw-bold text-primary">98.5%</div>
                            <small class="text-muted">On-Time Delivery</small>
                        </div>
                        <div class="col-3">
                            <div class="fw-bold text-success">24</div>
                            <small class="text-muted">Trips Today</small>
                        </div>
                        <div class="col-3">
                            <div class="fw-bold text-info">₹2.4L</div>
                            <small class="text-muted">Revenue Today</small>
                        </div>
                        <div class="col-3">
                            <div class="fw-bold text-warning">5</div>
                            <small class="text-muted">Active Routes</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attractive Statistics Cards Row -->
        <div class="row mb-4">
            <!-- Total Trips Card -->
            <div class="col-xl-3 col-lg-6 mb-3">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-truck"></i>
                    </div>
                    <div class="stat-card-title">🚛 Total Trips</div>
                    <div class="stat-card-value">1,248</div>
                    <div class="stat-card-change positive">
                        <i class="uil-arrow-up"></i>
                        <span>+12.5% from last month</span>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Target: 1,500 this month</small>
                        <div class="progress mt-1" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 83%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Drivers Card -->
            <div class="col-xl-3 col-lg-6 mb-3">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-user-check"></i>
                    </div>
                    <div class="stat-card-title">👥 Active Drivers</div>
                    <div class="stat-card-value">42</div>
                    <div class="stat-card-change positive">
                        <i class="uil-arrow-up"></i>
                        <span>+8.3% increase</span>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">15 drivers on leave</small>
                        <div class="progress mt-1" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 74%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-xl-3 col-lg-6 mb-3">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-rupee"></i>
                    </div>
                    <div class="stat-card-title">💰 Total Revenue</div>
                    <div class="stat-card-value">₹12.5L</div>
                    <div class="stat-card-change positive">
                        <i class="uil-arrow-up"></i>
                        <span>+15.2% growth</span>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Monthly target: ₹15L</small>
                        <div class="progress mt-1" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 83%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders Card -->
            <div class="col-xl-3 col-lg-6 mb-3">
                <div class="stat-card">
                    <div class="stat-card-icon">
                        <i class="uil-hourglass"></i>
                    </div>
                    <div class="stat-card-title">⏳ Pending Orders</div>
                    <div class="stat-card-value">23</div>
                    <div class="stat-card-change negative">
                        <i class="uil-arrow-down"></i>
                        <span>-3.2% decrease</span>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Clear by EOD target</small>
                        <div class="progress mt-1" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compact Charts Section -->
        <div class="row mb-3">
            <!-- Trips Over Time Chart -->
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="chart-header d-flex justify-content-between align-items-center">
                        <h5 class="chart-title mb-0">
                            <i class="uil-chart-area me-2"></i>
                            Trips Over Time
                        </h5>
                        <div class="chart-actions">
                            <button class="chart-action-btn">Week</button>
                            <button class="chart-action-btn active">Month</button>
                            <button class="chart-action-btn">Year</button>
                        </div>
                    </div>
                    <div style="height: 280px;">
                        <canvas id="tripsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="col-lg-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title mb-0">
                            <i class="uil-pie-chart me-2"></i>
                            Status Distribution
                        </h5>
                    </div>
                    <div style="height: 280px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Engaging Activity Section -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="activity-card">
                    <h5 class="section-title mb-3">
                        <i class="uil-history me-2"></i>
                        📈 Recent Activity
                    </h5>

                    <div class="activity-item">
                        <div class="activity-icon bg-success">
                            <i class="uil-check-circle text-white"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">✅ Trip #T-2024-001 Completed Successfully</p>
                            <p class="activity-time">2 hours ago • Delhi → Mumbai • ₹45,000</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon bg-info">
                            <i class="uil-truck text-white"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">🚛 Trip #T-2024-002 Now In Transit</p>
                            <p class="activity-time">30 minutes ago • Bangalore → Chennai • Driver: Rajesh</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon bg-warning">
                            <i class="uil-clock text-white"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">⏰ Trip #T-2024-003 Awaiting Driver Assignment</p>
                            <p class="activity-time">1 hour ago • Hyderabad → Pune • Priority: High</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon bg-primary">
                            <i class="uil-check-double text-white"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">🎯 Trip #T-2024-004 Delivered & Verified</p>
                            <p class="activity-time">3 hours ago • Kolkata → Delhi • POD Received</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon bg-danger">
                            <i class="uil-exclamation-triangle text-white"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">⚠️ Trip #T-2024-005 Delayed - Weather Conditions</p>
                            <p class="activity-time">4 hours ago • Jaipur → Ahmedabad • ETA: +2hrs</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Performers -->
            <div class="col-lg-6">
                <div class="activity-card">
                    <h5 class="section-title mb-3">
                        <i class="uil-crown me-2"></i>
                        Top Performers
                    </h5>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #166534, #1a7d3a);">
                            <i class="uil-trophy text-white"></i>
                        </div>
                        <div class="activity-content">
                            <p class="activity-title">Rajesh Kumar</p>
                            <p class="activity-time">12 trips completed this month</p>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <i class="uil-star text-white"></i>
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

        <!-- Engaging Data Table Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="uil-list-ul me-2"></i>
                            📊 Trip Performance Overview
                        </h5>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 200px;">
                                <span class="input-group-text"><i class="uil-search"></i></span>
                                <input type="text" class="form-control form-control-sm" placeholder="Search trips...">
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="uil-export me-1"></i>Export
                            </button>
                            <button class="btn btn-sm btn-primary">
                                <i class="uil-plus me-1"></i>New Trip
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">Trip ID</th>
                                        <th style="width: 140px;">Driver</th>
                                        <th style="width: 160px;">Route</th>
                                        <th style="width: 120px;">Status</th>
                                        <th style="width: 110px;">Date</th>
                                        <th style="width: 120px;">Revenue</th>
                                        <th style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary">#T-2024-001</span>
                                            <br><small class="text-muted">LR: LR001234</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-primary rounded-circle">RK</span>
                                                </div>
                                                Rajesh Kumar
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium">Delhi → Mumbai</span>
                                            <br><small class="text-muted">850 km • 14 hrs</small>
                                        </td>
                                        <td><span class="badge bg-success">✅ Completed</span></td>
                                        <td>
                                            Jan 15, 2024
                                            <br><small class="text-muted">2:30 PM</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">₹45,000</span>
                                            <br><small class="text-muted">Profit: ₹8,500</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-sm btn-outline-secondary" title="View Details">
                                                    <i class="uil-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary" title="Edit Trip">
                                                    <i class="uil-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Print Invoice">
                                                    <i class="uil-print"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary">#T-2024-002</span>
                                            <br><small class="text-muted">LR: LR001235</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-success rounded-circle">PS</span>
                                                </div>
                                                Priya Sharma
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium">Bangalore → Chennai</span>
                                            <br><small class="text-muted">350 km • 6 hrs</small>
                                        </td>
                                        <td><span class="badge bg-info">🚛 In Transit</span></td>
                                        <td>
                                            Jan 15, 2024
                                            <br><small class="text-muted">11:00 AM</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-info">₹32,000</span>
                                            <br><small class="text-muted">Est. Profit: ₹6,200</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-sm btn-outline-secondary" title="Track">
                                                    <i class="uil-map-marker"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary" title="Update">
                                                    <i class="uil-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" title="Contact Driver">
                                                    <i class="uil-phone"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary">#T-2024-003</span>
                                            <br><small class="text-muted">LR: LR001236</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-warning rounded-circle">AS</span>
                                                </div>
                                                Amit Singh
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium">Hyderabad → Pune</span>
                                            <br><small class="text-muted">550 km • 9 hrs</small>
                                        </td>
                                        <td><span class="badge bg-warning">⏳ Pending</span></td>
                                        <td>
                                            Jan 15, 2024
                                            <br><small class="text-muted">9:00 AM</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-warning">₹28,000</span>
                                            <br><small class="text-muted">Awaiting assignment</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-sm btn-outline-primary" title="Assign Driver">
                                                    <i class="uil-user-plus"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary" title="Edit">
                                                    <i class="uil-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Cancel">
                                                    <i class="uil-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary">#T-2024-004</span>
                                            <br><small class="text-muted">LR: LR001237</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-info rounded-circle">SP</span>
                                                </div>
                                                Sunita Patel
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-medium">Kolkata → Delhi</span>
                                            <br><small class="text-muted">1,450 km • 24 hrs</small>
                                        </td>
                                        <td><span class="badge bg-success">✅ Completed</span></td>
                                        <td>
                                            Jan 14, 2024
                                            <br><small class="text-muted">6:00 AM</small>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">₹52,000</span>
                                            <br><small class="text-muted">Profit: ₹12,000</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-sm btn-outline-secondary" title="View POD">
                                                    <i class="uil-file-check"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Invoice">
                                                    <i class="uil-receipt"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" title="Feedback">
                                                    <i class="uil-star"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing 4 of 1,248 trips • Page 1 of 312
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="uil-angle-left me-1"></i>Previous
                            </button>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="uil-arrow-down me-1"></i>Load More
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                Next<i class="uil-angle-right ms-1"></i>
                            </button>
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

<!-- Compact Dashboard JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Initialize compact charts with smaller sizes
document.addEventListener('DOMContentLoaded', function() {
    // Trips Chart
    const tripsCtx = document.getElementById('tripsChart').getContext('2d');
    new Chart(tripsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Trips',
                data: [120, 135, 148, 162, 178, 195],
                borderColor: '#727cf5',
                backgroundColor: 'rgba(114, 124, 245, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            },
            elements: {
                point: {
                    radius: 3
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'In Progress', 'Pending', 'Cancelled'],
            datasets: [{
                data: [65, 20, 10, 5],
                backgroundColor: [
                    '#0acf97',
                    '#39afd1',
                    '#ffbc00',
                    '#fa5c7c'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 11
                        },
                        padding: 10
                    }
                }
            }
        }
    });
});
</script>

@endsection