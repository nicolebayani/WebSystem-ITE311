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
                        <?php if (empty($available)) : ?>
                            <p class="text-muted mb-0">No new courses available for enrollment.</p>
                        <?php else : ?>
                            <div class="list-group" id="available-courses-list">
                                <?php foreach ($available as $course) : ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= esc($course['title'] ?? 'Untitled Course') ?>
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
