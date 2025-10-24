<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Material - LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload Material for Course ID: <?= esc($course_id); ?></h2>

        <?php if (isset($validation)): ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?= form_open_multipart('teacher/course/' . $course_id . '/upload'); ?>
        <!-- Debug: Form action URL: teacher/course/<?= $course_id ?>/upload -->
            <div class="mb-3">
                <label for="material" class="form-label">Select File (PDF, PPT, DOC)</label>
                <input type="file" name="material" class="form-control" id="material" required accept=".pdf,.ppt,.pptx,.doc,.docx">
                <div class="form-text">Maximum file size: 10MB. Allowed formats: PDF, PPT, PPTX, DOC, DOCX</div>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="<?= base_url('teacher/course/' . $course_id) ?>" class="btn btn-secondary ms-2">Cancel</a>
        <?= form_close(); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
