<?php
helper('url');
$user = session()->get('user') ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/modern.css?v=1.0') ?>" />
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/user_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'User') ?></h2>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Your Profile</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> <?= esc($user['name'] ?? '-') ?></p>
                        <p><strong>Email:</strong> <?= esc($user['email'] ?? '-') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-content {
            margin-left: 240px; /* sidebar width */
            min-height: 100vh;
            background: #ffffff;
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