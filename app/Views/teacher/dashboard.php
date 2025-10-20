<?php
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/modern.css?v=1.0') ?>" />
    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #5c0000;
            --white: #ffffff;
        }

        body {
            background-color: var(--white);
        }

        .dashboard-content {
            margin-left: 240px;
            min-height: 100vh;
            background-color: var(--white);
        }

        @media (max-width: 768px) {
            .dashboard-content {
                margin-left: 0;
            }
        }

        /* Card Styling */
        .card-header {
            background-color: var(--maroon);
            color: var(--white);
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--maroon);
            border-color: var(--maroon);
        }
        .btn-primary:hover {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
        }

        /* Badge */
        .badge.bg-light.text-dark {
            background-color: var(--maroon) !important;
            color: var(--white) !important;
        }

        /* Sidebar toggle and navbar consistency */
        .navbar, .sidebar-header {
            background-color: var(--maroon);
            color: var(--white);
        }

        .list-group-item-action:hover {
            background-color: #f8eaea;
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/teacher_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0 text-maroon">Welcome, <?= esc($user['name'] ?? 'Teacher') ?></h2>
                    <span class="badge bg-light text-dark ms-3 text-uppercase">Teacher</span>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                <h5 class="mb-0">Your Courses</h5>
                            </div>
                            <div class="card-body">
                                <?php $courses = $courses ?? []; ?>
                                <?php if (empty($courses)): ?>
                                    <p class="text-muted mb-0">No courses yet. Use the button to create one.</p>
                                <?php else: ?>
                                    <div class="list-group">
                                        <?php foreach ($courses as $course): ?>
                                            <a href="<?= site_url('teacher/course/' . ($course['id'] ?? '')) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <span><?= esc($course['title'] ?? 'Untitled Course') ?></span>
                                                <span class="badge bg-secondary"><?= esc($course['students'] ?? 0) ?> students</span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer bg-white text-end">
                                <a class="btn btn-primary" href="<?= base_url('teacher/create-course') ?>">Create New Course</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">Notifications</h6>
                            </div>
                            <div class="card-body">
                                <?php $notifications = $notifications ?? []; ?>
                                <?php if (empty($notifications)): ?>
                                    <p class="text-muted mb-0">You're all caught up.</p>
                                <?php else: ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($notifications as $note): ?>
                                            <li class="list-group-item"><?= esc($note) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-header">
                                <h6 class="mb-0">Recent Activity</h6>
                            </div>
                            <div class="card-body">
                                <?php $recent = $recent_activity ?? []; ?>
                                <?php if (empty($recent)): ?>
                                    <p class="text-muted mb-0">Nothing to show yet.</p>
                                <?php else: ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($recent as $item): ?>
                                            <li class="list-group-item"><?= esc($item) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
