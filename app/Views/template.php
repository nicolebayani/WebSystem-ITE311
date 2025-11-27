<?php

helper('url');


$path = trim(service('uri')->getPath(), '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEARNIFY</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .welcome-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            color: #fff;
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        .welcome-card h1 {
            font-weight: bold;
            text-shadow: 0 2px 5px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8B0000;">
    <div class="container">
        
        <a class="navbar-brand fw-bold" href="<?= site_url() ?>">LEARNIFY</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $path === '' ? 'active' : '' ?>" href="<?= site_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path === 'contact' ? 'active' : '' ?>" href="<?= site_url('contact') ?>">Contact</a>
                </li>
                
                <?php if (session()->get('isLoggedIn')): ?>
                    <?php $userRole = session()->get('role'); ?>
                    
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-badge" style="display: none;">
                                0
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationsDropdown" style="min-width: 300px; max-height: 400px; overflow-y: auto;">
                            <li class="dropdown-header d-flex justify-content-between align-items-center">
                                <span>Notifications</span>
                                <button class="btn btn-sm btn-outline-secondary" id="mark-all-read" style="display: none;">Mark all read</button>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li id="notifications-list">
                                <div class="text-center text-muted py-3">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="mt-2">Loading notifications...</div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dashboard
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if ($userRole === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('admin/dashboard') ?>">Admin Dashboard</a></li>
                                <li><a class="dropdown-item" href="#">Manage Users</a></li>
                                <li><a class="dropdown-item" href="#">Manage Courses</a></li>
                            <?php elseif ($userRole === 'teacher'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('teacher/dashboard') ?>">Teacher Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('teacher/courses') ?>">My Courses</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('teacher/create-course') ?>">Create Course</a></li>
                            <?php elseif ($userRole === 'student'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('student/dashboard') ?>">Student Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('student/courses') ?>">My Courses</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('student/grades') ?>">Grades</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= site_url('user/dashboard') ?>">User Dashboard</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('logout') ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('register') ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<div class="container d-flex align-items-center justify-content-center flex-grow-1 py-5">
    <div class="welcome-card">
        <h1>Welcome to LEARNIFY</h1>
    </div>
</div>

<!-- Notifications script moved to a single location in the admin layout to avoid duplicates -->

</body>
</html>
