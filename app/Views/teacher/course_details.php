<?php
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Course Details</title>
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

        /* Centering wrapper for content cards */
        .center-wrapper {
            padding-top: 6px;
            padding-bottom: 6px;
        }

        .card-header.custom {
            background-color: var(--maroon);
            color: var(--white);
        }

        .btn-back {
            background: transparent;
            border: 1px solid #ddd;
            color: #333;
        }

        /* Oval maroon button */
        .btn-oval {
            background-color: var(--maroon);
            color: var(--white);
            border: 1px solid var(--maroon);
            border-radius: 999px;
            padding: 6px 14px;
            box-shadow: none;
        }

        .btn-oval:hover, .btn-oval:focus {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
            color: var(--white);
            text-decoration: none;
        }
        @media (max-width: 991px) {
            .dashboard-content { margin-left: 0; }
            .center-wrapper { padding-left: 16px; padding-right: 16px; }
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
        <?= $this->include('partials/teacher_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container py-4">
                <div class="d-flex align-items-center mb-3">
                    <a href="<?= base_url('teacher/dashboard') ?>" class="btn btn-oval btn-sm me-2">
                        <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
                    </a>
                    <?php if (isset($course['id']) && $course['id'] > 0): ?>
                        <a href="<?= site_url('materials/upload/' . $course['id']) ?>" class="btn btn-oval btn-sm">
                            <i class="bi bi-upload me-1"></i>Upload Material
                        </a>
                    <?php endif; ?>
                </div>

                <div class="center-wrapper d-flex justify-content-center">
                    <div class="card border-0 shadow-sm w-100" style="max-width:1000px;">
                        <div class="card-header custom">
                            <h5 class="mb-0"><?= esc($course['title'] ?? 'Course') ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-4"><?= esc($course['description'] ?? '') ?></p>

                            <h6 class="mb-3">Enrolled Students (<?= count($students ?? []) ?>)</h6>

                            <?php if (empty($students)): ?>
                                <p class="text-muted">No students enrolled yet.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:48px">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Course</th>
                                                <th>Enrolled At</th>
                                                <th style="width:130px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($students as $i => $s): ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= esc($s['name']) ?></td>
                                                    <td><?= esc($s['email']) ?></td>
                                                    <td><?= esc($course['title'] ?? '-') ?></td>
                                                    <td>
                                                        <?php
                                                            if (!empty($s['enrollment_date']) && $s['enrollment_date'] !== '0000-00-00 00:00:00') {
                                                                $dt = new \DateTime($s['enrollment_date']);
                                                                echo $dt->format('M d, Y \a\t h:i A');
                                                            } else {
                                                                echo 'N/A';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="<?= site_url('teacher/course/' . ($course['id'] ?? '') . '/unenroll') ?>" onsubmit="return confirm('Are you sure you want to unenroll <?= addslashes(esc($s['name'])) ?> from this course?');">
                                                            <input type="hidden" name="user_id" value="<?= esc($s['id']) ?>">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">Unenroll</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="center-wrapper d-flex justify-content-center">
            <div class="card border-0 shadow-sm w-100" style="max-width:1000px;">
                <div class="card-header custom">
                    <h5 class="mb-0"><i class="bi bi-journal-text me-2"></i>Courses You Teach</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th style="width:120px;">Term</th>
                                    <th>Course</th>
                                    <th style="width:160px;">Subject Code</th>
                                    <th style="width:100px;">Unit</th>
                                    <th style="width:160px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($courses ?? [])): ?>
                                    <?php foreach ($courses as $c): ?>
                                        <tr>
                                            <td><?= esc($c['term'] ?? '-') ?></td>
                                            <td><?= esc($c['title'] ?? '-') ?></td>
                                            <td><?= esc($c['code'] ?? '-') ?></td>
                                            <td><?= esc($c['unit'] ?? '-') ?></td>
                                            <td>
                                                <?php $cid = (int)($c['id'] ?? 0); ?>
                                                <?php if ($cid > 0): ?>
                                                    <a class="btn btn-sm btn-outline-primary" href="<?= site_url('materials/upload/' . $cid) ?>">
                                                        <i class="bi bi-upload me-1"></i>Upload Material
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">No course ID</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">You are not assigned to any courses yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>