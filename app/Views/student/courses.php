<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enroll in a Course</title>
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
        .dashboard-content {
            margin-left: 0; /* Adjusted for pages without a fixed sidebar */
            min-height: 100vh;
            background: var(--light-bg);
        }
        .card-header {
            background-color: var(--maroon) !important;
            color: white !important;
        }
        h2 {
            color: var(--maroon-dark);
        }
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
            color: #ffffffff !important; /* gold hover/active effect */
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
    </style>
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/student_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0">Enroll in a Course</h2>
                </div>

                <div id="enrollment-alert"></div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Available Courses</h5>
                    </div>
                    <div class="card-body">
                        <?php $available = $available_courses ?? []; ?>

                        <!-- Enrolled courses (if any) -->
                        <?php $enrolled = $enrolled_courses ?? []; ?>
                        <?php if (!empty($enrolled)) : ?>
                            <div class="mb-4">
                                <h6>Your Enrolled Course<?= count($enrolled) > 1 ? 's' : '' ?></h6>
                                <div class="list-group">
                                    <?php foreach ($enrolled as $c) : ?>
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><?= esc($c['title'] ?? 'Untitled Course') ?></h5>
                                            </div>
                                            <p class="mb-1 text-muted"><?= esc($c['description'] ?? 'No description available.') ?></p>
                                            <small class="text-secondary">Instructor: <?= esc($c['instructor_name'] ?? 'TBA') ?></small>

                                            <?php if (!empty($c['materials'])): ?>
                                                <div class="mt-3">
                                                    <h6>Course Materials</h6>
                                                    <ul class="list-group list-group-flush">
                                                        <?php foreach ($c['materials'] as $material): ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <?= esc($material['file_name']) ?>
                                                                <a href="<?= site_url('student/material/' . $material['id'] . '/download') ?>" class="btn btn-sm btn-outline-primary">Download</a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">You are not enrolled in any courses yet.</p>
                        <?php endif; ?>

                        <hr />

                        <h6 class="mb-3">Available to Enroll</h6>
                        <?php if (empty($available)) : ?>
                            <p class="text-muted mb-0">No new courses available for enrollment.</p>
                        <?php else : ?>
                            <div class="list-group" id="available-courses-list">
                                <?php foreach ($available as $course) : ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong><?= esc($course['title'] ?? 'Untitled Course') ?></strong>
                                            <div class="small text-muted"><?= esc($course['description'] ?? '') ?></div>
                                        </div>
                                        <button class="btn btn-primary btn-sm enroll-btn" data-course-id="<?= $course['id'] ?>">Enroll</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
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

            $.post('<?= site_url('/course/enroll') ?>', { 
                course_id: courseId, 
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>' 
            }, function(response) {
                var alertDiv = $('#enrollment-alert');
                if (response.success) {
                    alertDiv.html('<div class="alert alert-success alert-dismissible fade show" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    button.closest('.list-group-item').remove();
                } else {
                    alertDiv.html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' + response.message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
            }, 'json');
        });
    });
    </script>
</body>
</html>
