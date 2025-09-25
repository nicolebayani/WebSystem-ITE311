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
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
  <div class="d-flex align-items-center mb-4">
    <h2 class="mb-0">Welcome, <?= esc($user['name'] ?? 'Admin') ?></h2>
    <span class="badge bg-danger ms-3 text-uppercase">Admin</span>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <div class="text-muted">Total Users</div>
              <div class="display-6 fw-bold"><?= esc($totalUsers ?? 0) ?></div>
            </div>
            <span class="badge bg-primary">Users</span>
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
            <span class="badge bg-success">Courses</span>
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
            <span class="badge bg-warning text-dark">Teachers</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm">
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
                <tr>
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
</body>
</html>


