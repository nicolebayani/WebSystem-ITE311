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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #5c0000;
            --maroon-light: #a13c3c;
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

        #searchInput {
            border-color: var(--maroon-light);
        }

        #searchInput:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 0.25rem rgba(128, 0, 0, 0.25);
        }

        .btn-outline-primary {
            color: var(--maroon);
            border-color: var(--maroon);
        }

        .btn-outline-primary:hover {
            background-color: var(--maroon);
            color: var(--white);
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
                                <form id="searchForm" action="<?= site_url('/courses/search') ?>" method="get" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" id="searchInput" name="search_term" class="form-control" placeholder="Search courses...">
                                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i> Search</button>
                                    </div>
                                </form>

                                <?php $courses = $courses ?? []; ?>
                                <div id="coursesContainer" class="row">
                                    <?php if (empty($courses)): ?>
                                        <div class="col-12">
                                            <p class="text-muted mb-0">No courses yet. Use the button to create one.</p>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($courses as $course): ?>
                                            <div class="col-md-6 mb-4 course-card">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= esc($course['title'] ?? 'Untitled Course') ?></h5>
                                                        <p class="card-text"><?= esc($course['description'] ?? 'No description.') ?></p>
                                                        <a href="<?= site_url('teacher/course/' . ($course['id'] ?? '')) ?>" class="btn btn-primary">View Course</a>
                                                    </div>
                                                    <div class="card-footer text-muted">
                                                        <?= esc($course['students'] ?? 0) ?> students enrolled
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        // Client-side filtering
        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.course-card').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        // Server-side search with AJAX
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            console.log('Search form submitted'); // Debugging line
            var searchTerm = $('#searchInput').val();

            $.get('<?= site_url('/courses/search') ?>', { search_term: searchTerm }, function(data) {
                var coursesContainer = $('#coursesContainer');
                coursesContainer.empty();

                if (data.length > 0) {
                    $.each(data, function(index, course) {
                        var courseHtml = 
                            '<div class="col-md-6 mb-4 course-card">' +
                                '<div class="card h-100">' +
                                    '<div class="card-body">' +
                                        '<h5 class="card-title">' + (course.title || 'Untitled Course') + '</h5>' +
                                        '<p class="card-text">' + (course.description || 'No description.') + '</p>' +
                                        '<a href="<?= site_url('teacher/course/') ?>' + course.id + '" class="btn btn-primary">View Course</a>' +
                                    '</div>' +
                                    '<div class="card-footer text-muted">' +
                                        (course.students || 0) + ' students enrolled' +
                                    '</div>' +
                                '</div>' +
                            '</div>';
                        coursesContainer.append(courseHtml);
                    });
                } else {
                    coursesContainer.html('<div class="alert alert-info">No courses found matching your search.</div>');
                }
            });
        });
    });
    </script>
</body>
</html>
