<?php
helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body { background: linear-gradient(135deg, #a72c2c, #e0b4b4); min-height: 100vh; }
      .navbar-theme { background-color: #8B0000 !important; }
      .card { border: 0; box-shadow: 0 8px 24px rgba(0,0,0,0.15); border-radius: 16px; transition: transform .35s ease, box-shadow .35s ease; }
      .card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.2); }
      .card-header { background: #fff; border-bottom: 0; }
      .badge-pill { border-radius: 999px; padding: .5rem .75rem; }

      /* Animations */
      @keyframes fadeInUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
      @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
      .reveal { opacity: 0; }
      .reveal.in-view { opacity: 1; animation: fadeInUp .6s ease forwards; }
      .reveal-fast.in-view { animation-duration: .45s; }
      .reveal-slow.in-view { animation-duration: .8s; }
      .stagger > * { opacity: 0; }
      .stagger.in-view > * { animation: fadeInUp .6s ease forwards; }
      .stagger.in-view > *:nth-child(1) { animation-delay: .05s; }
      .stagger.in-view > *:nth-child(2) { animation-delay: .15s; }
      .stagger.in-view > *:nth-child(3) { animation-delay: .25s; }
      .stagger.in-view > *:nth-child(4) { animation-delay: .35s; }
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
    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'Admin') ?></h2>
    <span class="badge bg-danger ms-3 text-uppercase">Admin</span>
  </div>

  <div class="row g-3 mb-4 stagger">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted">Total Users</div>
              <div class="display-6 fw-bold"><?= esc($totalUsers ?? 0) ?></div>
            </div>
            <span class="badge bg-primary badge-pill">Users</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted">Total Courses</div>
              <div class="display-6 fw-bold"><?= esc($totalCourses ?? 0) ?></div>
            </div>
            <span class="badge bg-success badge-pill">Courses</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted">Active Teachers</div>
              <div class="display-6 fw-bold"><?= esc($activeTeachers ?? 0) ?></div>
            </div>
            <span class="badge bg-warning text-dark badge-pill">Teachers</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm reveal reveal-slow">
    <div class="card-header bg-white">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Activity</h5>
        <div>
          <a href="#" class="btn btn-sm btn-outline-primary">Manage Users</a>
          <a href="#" class="btn btn-sm btn-outline-success">Manage Courses</a>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Action</th>
              <th scope="col">User</th>
              <th scope="col">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php $activity = $recentActivity ?? []; ?>
            <?php if (empty($activity)): ?>
              <tr><td colspan="4" class="text-center text-muted">No recent activity</td></tr>
            <?php else: ?>
              <?php foreach ($activity as $i => $row): ?>
                <tr class="reveal">
                  <th scope="row"><?= $i + 1 ?></th>
                  <td><?= esc($row['action'] ?? '-') ?></td>
                  <td><?= esc($row['user'] ?? '-') ?></td>
                  <td><?= esc($row['date'] ?? '-') ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
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


