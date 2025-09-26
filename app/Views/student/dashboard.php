<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/modern.css') ?>" />
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/student_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'Student') ?></h2>
                    <span class="badge bg-dark ms-3 text-uppercase">Student</span>
                </div>

                <div class="row g-3">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">My Courses</h5>
                            </div>
                            <div class="card-body">
                                <?php $courses = $enrolled_courses ?? []; ?>
                                <?php if (empty($courses)): ?>
                                    <p class="text-muted mb-0">You are not enrolled in any courses yet.</p>
                                <?php else: ?>
                                    <div class="list-group">
                                        <?php foreach ($courses as $course): ?>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <?= esc($course['title'] ?? 'Untitled Course') ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Recent Grades & Feedback</h5>
                            </div>
                            <div class="card-body">
                                <?php $grades = $recent_grades ?? []; ?>
                                <?php if (empty($grades)): ?>
                                    <p class="text-muted mb-0">No grades yet.</p>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Course</th>
                                                    <th>Assessment</th>
                                                    <th>Grade</th>
                                                    <th>Feedback</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($grades as $g): ?>
                                                    <tr>
                                                        <td><?= esc($g['course'] ?? '-') ?></td>
                                                        <td><?= esc($g['assessment'] ?? '-') ?></td>
                                                        <td><?= esc($g['grade'] ?? '-') ?></td>
                                                        <td><?= esc($g['feedback'] ?? '-') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white">
                                <h6 class="mb-0">Upcoming Deadlines</h6>
                            </div>
                            <div class="card-body">
                                <?php $deadlines = $upcoming_deadlines ?? []; ?>
                                <?php if (empty($deadlines)): ?>
                                    <p class="text-muted mb-0">No upcoming deadlines.</p>
                                <?php else: ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($deadlines as $d): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><?= esc($d['title'] ?? '-') ?></span>
                                                <span class="badge bg-secondary"><?= esc($d['due'] ?? '-') ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-white">
                                <h6 class="mb-0">Notifications</h6>
                            </div>
                            <div class="card-body">
                                <?php $notifications = $notifications ?? []; ?>
                                <?php if (empty($notifications)): ?>
                                    <p class="text-muted mb-0">You're all caught up.</p>
                                <?php else: ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($notifications as $n): ?>
                                            <li class="list-group-item"><?= esc($n) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
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
