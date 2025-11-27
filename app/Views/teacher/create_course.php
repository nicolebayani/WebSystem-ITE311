<?php
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create New Course</title>
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
            padding: 2rem;
            min-height: 100vh;
            background-color: var(--white);
        }

        @media (max-width: 768px) {
            .dashboard-content {
                margin-left: 0;
            }
        }

        .card-header {
            background-color: var(--maroon);
            color: var(--white);
        }

        .btn-primary {
            background-color: var(--maroon);
            border-color: var(--maroon);
        }
        .btn-primary:hover {
            background-color: var(--maroon-dark);
            border-color: var(--maroon-dark);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?= $this->include('partials/teacher_sidebar') ?>

        <div id="content" class="dashboard-content">
            <div class="container">
                <h2 class="mb-4 text-maroon">Create New Course</h2>

                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Course Details</h5>
                    </div>
                    <div class="card-body">
                        <?php if (session()->get('errors')): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach (session()->get('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('teacher/store-course') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="title" class="form-label">Course Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Course Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?= old('description') ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Course</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>