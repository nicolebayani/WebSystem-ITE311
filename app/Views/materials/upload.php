<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Material</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Upload New Material for Course ID: <?= esc($course_id) ?></h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?= form_open_multipart('course/upload/' . $course_id) ?>
        <div class="form-group">
            <label for="material">Select File</label>
            <input type="file" name="material" class="form-control-file" id="material" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    <?= form_close() ?>

</div>

</body>
</html>
