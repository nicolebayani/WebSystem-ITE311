<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>My Courses</h2>
    <div class="list-group">
        <?php if (!empty($enrolled_courses)): ?>
            <?php foreach ($enrolled_courses as $course): ?>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?= esc($course['title']) ?></h5>
                    <p class="mb-1"><?= esc($course['description']) ?></p>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You are not enrolled in any courses.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
