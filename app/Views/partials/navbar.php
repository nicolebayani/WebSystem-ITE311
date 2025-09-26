<?php

helper('url');


$path = trim(service('uri')->getPath(), '/');
?>
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
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if ($userRole === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('admin/dashboard') ?>">Admin Dashboard</a></li>
                                <li><a class="dropdown-item" href="#">Manage Users</a></li>
                                <li><a class="dropdown-item" href="#">Manage Courses</a></li>
                            <?php elseif ($userRole === 'teacher'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('teacher/dashboard') ?>">Teacher Dashboard</a></li>
                                <li><a class="dropdown-item" href="#">My Courses</a></li>
                                <li><a class="dropdown-item" href="#">Create Course</a></li>
                            <?php elseif ($userRole === 'student'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('student/dashboard') ?>">Student Dashboard</a></li>
                                <li><a class="dropdown-item" href="#">My Courses</a></li>
                                <li><a class="dropdown-item" href="#">Grades</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= site_url('user/dashboard') ?>">User Dashboard</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= site_url('logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $path === 'login' ? 'active' : '' ?>" href="<?= site_url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $path === 'register' ? 'active' : '' ?>" href="<?= site_url('register') ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
