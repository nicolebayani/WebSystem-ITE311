<?php
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/modern.css') ?>" />
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/user_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'User') ?></h2>
                    <span class="badge bg-light text-dark ms-3 text-uppercase">User</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Your Profile</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-0">Welcome to your user dashboard. This is where you can manage your profile and settings.</p>
                            </div>
                            <div class="card-footer bg-white text-end">
                                <a class="btn btn-primary" href="#">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-white">
                                <h6 class="mb-0">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm">View Profile</a>
                                    <a href="#" class="btn btn-outline-secondary btn-sm">Settings</a>
                                    <a href="/logout" class="btn btn-outline-danger btn-sm">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
