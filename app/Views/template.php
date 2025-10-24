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

</body>
</html>
