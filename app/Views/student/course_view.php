<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <h2><?= esc($course['title']); ?></h2>
    <p><?= esc($course['description']); ?></p>

    <hr>

    <h3>Course Materials</h3>
    <?php if (!empty($materials)): ?>
        <ul class="list-group">
            <?php foreach ($materials as $material): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= esc($material['file_name']); ?>
                    <a href="/materials/download/<?= $material['id']; ?>" class="btn btn-primary btn-sm">Download</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No materials have been uploaded for this course yet.</p>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>