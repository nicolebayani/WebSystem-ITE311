<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Dashboard</title>
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
            color: #ffd700 !important; /* gold hover/active effect */
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
            margin-left: 240px; /* sidebar width */
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

        .card-header {
            background-color: var(--maroon) !important;
            color: white !important;
            font-weight: 500;
            border-bottom: none;
        }

        .card-header h5,
        .card-header h6 {
            color: white !important;
        }

        /* --- BADGES --- */
        .badge.bg-dark {
            background-color: var(--maroon) !important;
        }

        .badge.bg-secondary {
            background-color: var(--maroon-light) !important;
        }

        /* --- TABLES --- */
        table thead {
            background-color: var(--maroon);
            color: white;
        }

        table tbody tr:hover {
            background-color: #f9eaea;
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
        <?= $this->include('partials/student_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'Student') ?></h2>
                    <span class="badge bg-dark ms-3 text-uppercase">Student</span>
                </div>

                <div id="enrollment-alert"></div>

                <div class="row g-3">
                    <div class="col-lg-8">
                        <!-- My Courses -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">My Courses</h5>
                            </div>
                            <div class="card-body">
                                <?php $courses = $enrolled_courses ?? []; ?>
                                <?php if (empty($courses)): ?>
                                    <p class="text-muted mb-0">You are not enrolled in any courses yet.</p>
                                <?php else: ?>
                                    <div class="list-group" id="enrolled-courses-list">
                                        <?php foreach ($courses as $course): ?>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <?= esc($course['title'] ?? 'Untitled Course') ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Available Courses -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">Available Courses</h5>
                            </div>
                            <div class="card-body">
                                <?php $available = $available_courses ?? []; ?>
                                <?php if (empty($available)): ?>
                                    <p class="text-muted mb-0">No new courses available for enrollment.</p>
                                <?php else: ?>
                                    <div class="list-group" id="available-courses-list">
                                        <?php foreach ($available as $course): ?>
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= esc($course['title'] ?? 'Untitled Course') ?>
                                                <button class="btn btn-primary btn-sm enroll-btn" data-course-id="<?= $course['id'] ?>">Enroll</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Recent Grades & Feedback -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-header">
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

                        <!-- Upcoming Deadlines -->
                        <div class="card shadow-sm">
                            <div class="card-header">
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

                    <!-- Notifications -->
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header">
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#available-courses-list').on('click', '.enroll-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var courseId = button.data('course-id');

            $.post('<?= site_url('/course/enroll') ?>', { course_id: courseId, csrf_test_name: '<?= csrf_hash() ?>' }, function(response) {
                var alertDiv = $('#enrollment-alert');
                if (response.success) {
                    alertDiv.html('<div class="alert alert-success alert-dismissible fade show" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    
                    var courseItem = button.closest('.list-group-item');
                    var courseTitle = courseItem.contents().filter(function() {
                        return this.nodeType === 3;
                    }).text().trim();

                    // Add to enrolled list
                    if ($('#enrolled-courses-list').find('.list-group-item').length === 0) {
                        $('#enrolled-courses-list').html(''); // Remove the 'not enrolled' message
                    }
                    $('#enrolled-courses-list').append('<a href="#" class="list-group-item list-group-item-action">' + courseTitle + '</a>');
                    
                    // Remove from available list
                    courseItem.remove();

                    if ($('#available-courses-list').children().length === 0) {
                        $('#available-courses-list').html('<p class="text-muted mb-0">No new courses available for enrollment.</p>');
                    }

                } else {
                    alertDiv.html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            }, 'json');
        });
    });
    </script>
</body>
</html>