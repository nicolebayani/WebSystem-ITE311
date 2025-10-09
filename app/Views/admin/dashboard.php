<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/modern.css?v=1.0') ?>" />
    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #5a0000;
            --maroon-light: #a13c3c;
            --light-bg: #ffffff;
        }

        body {
            background-color: var(--light-bg);
            color: #333;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: var(--maroon) !important;
        }

        .navbar .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        .navbar .nav-link {
            color: white !important;
            transition: color 0.2s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color:rgb(255, 255, 255) !important; /* gold hover/active effect */
        }

        .navbar .dropdown-menu {
            background-color: var(--maroon-dark) !important;
        }

        .navbar .dropdown-item {
            color: white !important;
        }

        .navbar .dropdown-item:hover {
            background-color: var(--maroon-light) !important;
            color: white !important;
        }

        /* --- DASHBOARD CONTENT --- */
        .dashboard-content {
            margin-left: 240px;
            min-height: 100vh;
            background: var(--light-bg);
        }

        @media (max-width: 768px) {
            .dashboard-content {
                margin-left: 0;
            }
        }

        /* --- CARDS --- */
        .card {
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(128, 0, 0, 0.15);
        }

        /* Card header styling */
        .card-header {
            background-color: var(--maroon) !important;
            color: white !important;
            font-weight: 500;
            border-bottom: none;
        }

        .card-header h5 {
            color: white !important;
        }

        /* --- BADGES --- */
        .badge.bg-primary {
            background-color: var(--maroon) !important;
        }

        .badge.bg-success {
            background-color: #a13c3c !important;
        }

        .badge.bg-warning {
            background-color: #f5c6cb !important;
            color: var(--maroon-dark) !important;
        }

        .badge.bg-info {
            background-color: #f8d7da !important;
            color: var(--maroon-dark) !important;
        }

        .badge.bg-danger {
            background-color: var(--maroon-dark) !important;
        }

        .badge.bg-secondary {
            background-color: var(--maroon-light) !important;
        }

        /* --- BUTTONS --- */
        .btn-outline-primary {
            border-color: white !important;
            color: white !important;
        }

        .btn-outline-primary:hover {
            background-color: white !important;
            color: var(--maroon) !important;
        }

        .btn-outline-success {
            border-color: white !important;
            color: white !important;
        }

        .btn-outline-success:hover {
            background-color: white !important;
            color: var(--maroon-dark) !important;
        }

        /* --- TABLES --- */
        table thead {
            background-color: var(--maroon);
            color: white;
        }

        table tbody tr:hover {
            background-color: #f9eaea;
        }

        /* --- HEADINGS --- */
        h2 {
            color: var(--maroon-dark);
        }

        /* Adjust spacing for buttons in headers */
        .card-header .btn {
            margin-left: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/admin_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'Admin') ?></h2>
                    <span class="badge bg-danger ms-3 text-uppercase">Admin</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted">Total Users</div>
                                        <div class="display-6 fw-bold"><?= esc($totalUsers ?? 0) ?></div>
                                    </div>
                                    <span class="badge bg-primary badge-pill">Users</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted">Total Courses</div>
                                        <div class="display-6 fw-bold"><?= esc($totalCourses ?? 0) ?></div>
                                    </div>
                                    <span class="badge bg-success badge-pill">Courses</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted">Active Teachers</div>
                                        <div class="display-6 fw-bold"><?= esc($activeTeachers ?? 0) ?></div>
                                    </div>
                                    <span class="badge bg-warning text-dark badge-pill">Teachers</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="text-muted">Active Students</div>
                                        <div class="display-6 fw-bold"><?= esc($activeStudents ?? 0) ?></div>
                                    </div>
                                    <span class="badge bg-info badge-pill">Students</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maroon Navbar Header -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Activity</h5>
                        <div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Manage Users</a>
                            <a href="#" class="btn btn-sm btn-outline-success">Manage Courses</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $activity = $recentActivity ?? []; ?>
                                    <?php if (empty($activity)): ?>
                                        <tr><td colspan="5" class="text-center text-muted">No recent activity</td></tr>
                                    <?php else: ?>
                                        <?php foreach ($activity as $i => $row): ?>
                                            <tr>
                                                <th scope="row"><?= $i + 1 ?></th>
                                                <td><?= esc($row['name'] ?? '-') ?></td>
                                                <td><?= esc($row['email'] ?? '-') ?></td>
                                                <td><span class="badge bg-secondary"><?= esc(ucfirst($row['role'] ?? '-')) ?></span></td>
                                                <td><?= esc(date('M d, Y', strtotime($row['created_at'] ?? ''))) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
