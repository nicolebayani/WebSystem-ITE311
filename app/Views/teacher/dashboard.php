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
    <style>
      body { background: linear-gradient(135deg, #a72c2c, #e0b4b4); min-height: 100vh; }
      .navbar-theme { background-color: #8B0000 !important; }
      .card { border: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.15); border-radius: 16px; transition: transform .35s ease, box-shadow .35s ease; }
      .card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.2); }
      .card-header { background: #fff; border-bottom: 0; }
      .badge-pill { border-radius: 999px; padding: .5rem .75rem; }

      @keyframes fadeInUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
      .reveal { opacity: 0; }
      .reveal.in-view { opacity: 1; animation: fadeInUp .6s ease forwards; }
      .stagger > * { opacity: 0; }
      .stagger.in-view > * { animation: fadeInUp .6s ease forwards; }
      .stagger.in-view > *:nth-child(1) { animation-delay: .05s; }
      .stagger.in-view > *:nth-child(2) { animation-delay: .15s; }
      .stagger.in-view > *:nth-child(3) { animation-delay: .25s; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-theme">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= site_url('/') ?>">LEARNIFY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>">Logout</a></li>
      </ul>
    </div>
  </div>
  </nav>

<div class="container py-4">
  <div class="d-flex align-items-center mb-4 reveal">
    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'Teacher') ?></h2>
    <span class="badge bg-light text-dark ms-3 text-uppercase">Teacher</span>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm h-100 reveal">
        <div class="card-header bg-white">
          <h5 class="mb-0">Your Courses</h5>
        </div>
        <div class="card-body">
          <?php $courses = $courses ?? []; ?>
          <?php if (empty($courses)): ?>
            <p class="text-muted mb-0">No courses yet. Use the button to create one.</p>
          <?php else: ?>
            <div class="list-group stagger">
              <?php foreach ($courses as $course): ?>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                  <span><?= esc($course['title'] ?? 'Untitled Course') ?></span>
                  <span class="badge bg-secondary"><?= esc($course['students'] ?? 0) ?> students</span>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="card-footer bg-white text-end">
          <a class="btn btn-primary" href="#">Create New Course</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm mb-3 reveal">
        <div class="card-header bg-white">
          <h6 class="mb-0">Notifications</h6>
        </div>
        <div class="card-body">
          <?php $notifications = $notifications ?? []; ?>
          <?php if (empty($notifications)): ?>
            <p class="text-muted mb-0">You're all caught up.</p>
          <?php else: ?>
            <ul class="list-group list-group-flush stagger">
              <?php foreach ($notifications as $note): ?>
                <li class="list-group-item"><?= esc($note) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
      <div class="card border-0 shadow-sm reveal">
        <div class="card-header bg-white">
          <h6 class="mb-0">Recent Activity</h6>
        </div>
        <div class="card-body">
          <?php $recent = $recent_activity ?? []; ?>
          <?php if (empty($recent)): ?>
            <p class="text-muted mb-0">Nothing to show yet.</p>
          <?php else: ?>
            <ul class="list-group list-group-flush stagger">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    document.querySelectorAll('.reveal, .stagger').forEach(el => observer.observe(el));
  })();
</script>
</body>
</html>


