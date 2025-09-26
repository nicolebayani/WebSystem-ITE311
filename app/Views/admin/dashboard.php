<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/modern.css') ?>" />
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

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Activity</h5>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary">Manage Users</a>
                                <a href="#" class="btn btn-sm btn-outline-success">Manage Courses</a>
                            </div>
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
</body>
</html>

        </div>
    </div>

    <style>
        .dashboard-content {
            margin-left: 240px; /* sidebar width */
            min-height: 100vh;
            background: #f8f9fa;
        }
        @media (max-width: 768px) {
            .dashboard-content {
                margin-left: 0;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
