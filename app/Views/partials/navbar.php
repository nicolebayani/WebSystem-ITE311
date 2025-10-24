<?php
helper('url');
$path = trim(service('uri')->getPath(), '/');
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #800000 !important;">
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
                <!-- Add Font Awesome for icons -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
                
                <?php if (session()->get('isLoggedIn')): ?>
                    <?= view('partials/notifications') ?>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a class="nav-link <?= $path === '' ? 'active' : '' ?>" href="<?= site_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path === 'about' ? 'active' : '' ?>" href="<?= site_url('about') ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path === 'contact' ? 'active' : '' ?>" href="<?= site_url('contact') ?>">Contact</a>
                </li>

                <?php if (false): // Temporarily disabled sessions ?>
                    <?php $userRole = 'guest'; ?>
                    <li class="nav-item dropdown">
                        <?php
                        // Add an active look to the Dashboard dropdown when any student route is active
                        $isStudentSection = strpos($path, 'student') === 0;
                        ?>
                        <a class="nav-link dropdown-toggle <?= $isStudentSection ? 'active' : '' ?>" href="#" id="navbarDropdown" role="button"
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
                                <li><a class="dropdown-item" href="<?= site_url('student/courses') ?>">My Courses</a></li>
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

<!-- Additional rule: ensure collapsed nav (mobile) uses maroon background for active items -->
<style>
    /* Stronger rules to prevent other CSS from overriding the navbar color */
    .navbar,
    .navbar-collapse,
    .navbar.navbar-dark {
        background-color: #800000 !important;
        border-color: #800000 !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand,
    .navbar .dropdown-item {
        color: #ffffffcc !important;
    }

    .navbar .nav-link.active {
        color: #fff !important;
        background-color: rgba(255,255,255,0.12) !important;
        border-radius: 5px;
    }

    /* Ensure the dropdown toggle text remains white when active */
    .navbar .dropdown-toggle.active {
        color: #fff !important;
    }

    /* Ensure the collapsed (mobile) menu has maroon background so active shows consistently */
    .navbar-collapse {
        background-color: #800000 !important;
    }

    /* Notifications Styling */
    .notification-dropdown {
        min-width: 300px;
        padding: 0;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .notification-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #eee;
        white-space: normal;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-item small {
        display: block;
        margin-bottom: 0.25rem;
    }

    .notification-item p {
        color: #333;
        margin-bottom: 0;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    /* Bell icon styling */
    .fa-bell {
        font-size: 1.2rem;
        color: white;
    }

    /* Badge styling */
    .badge.bg-danger {
        font-size: 0.6rem;
        padding: 0.25em 0.5em;
    }
</style>
