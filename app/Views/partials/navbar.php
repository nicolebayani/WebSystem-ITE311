<?php
helper('url');
$path = trim(service('uri')->getPath(), '/');
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #800000;">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold text-white" href="<?= site_url() ?>">LEARNIFY</a>

        <!-- Toggler (for mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Dashboard
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown" aria-labelledby="navbarDropdown">
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
                            <li><a class="dropdown-item text-danger" href="<?= site_url('logout') ?>">Logout</a></li>
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

<!-- Maroon and White Theme Styles -->
<style>
    .navbar {
        box-shadow: 0 3px 8px rgba(128, 0, 0, 0.3);
    }

    .navbar .nav-link {
        color: #ffffffcc !important;
        transition: color 0.2s ease, background-color 0.2s ease;
        font-weight: 500;
    }

    .navbar .nav-link:hover,
    .navbar .nav-link.active {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 5px;
    }

    .navbar-brand {
        font-size: 1.4rem;
        letter-spacing: 1px;
    }

    /* Dropdown menu styling */
    .custom-dropdown {
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(128, 0, 0, 0.15);
        overflow: hidden;
    }

    .custom-dropdown .dropdown-item {
        color: #800000;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .custom-dropdown .dropdown-item:hover {
        background-color: #800000;
        color: #fff;
    }

    .custom-dropdown .dropdown-divider {
        border-color: #e6bcbc;
    }

    /* Logout item styling */
    .custom-dropdown .dropdown-item.text-danger:hover {
        background-color: #a13c3c;
    }

    /* Toggler (hamburger icon) */
    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        filter: brightness(0) invert(1);
    }
</style>
