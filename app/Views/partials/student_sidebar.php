<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php helper('url'); ?>
    <?php 
    $role = session()->get('role');
    $dashboardRoute = 'student/dashboard';
    $dashboardUrl = site_url($dashboardRoute);
    $isDashboardActive = url_is($dashboardRoute);
    ?>

    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="<?= esc($dashboardUrl) ?>">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="me-2">
                <path d="M12 2l9 6v8l-9 6-9-6V8l9-6zm0 2.2L5 8v6l7 4.7 7-4.7V8l-7-3.8z"/>
            </svg>
            <span class="fw-bold">Learnify Student</span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Dashboard Group -->
                <li class="nav-item">
                    <a class="nav-link <?= $isDashboardActive ? 'active' : '' ?>" href="<?= esc($dashboardUrl) ?>">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>

                <!-- Enrollment Link -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('student/courses') ?>">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M15 12c0 .55-.45 1-1 1h-2v2c0 .55-.45 1-1 1s-1-.45-1-1v-2H9c-.55 0-1-.45-1-1s.45-1 1-1h2V9c0-.55.45-1 1-1s1 .45 1 1v2h2c.55 0 1 .45 1 1zM8 20c0 1.1.9 2 2 2h4c1.1 0 2-.9 2-2v-2H8v2zm10-16H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h3.27c-.15-.58-.27-1.28-.27-2 0-3.31 2.69-6 6-6 .72 0 1.42.12 2.05.35L18 4c0-1.1-.9-2-2-2z"/>
                        </svg>
                        Enrollment
                    </a>
                </li>

                <!-- Learning Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="learningDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        Learning
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="learningDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('student/courses') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            My Courses
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('student/progress') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            Progress
                        </a></li>
                    </ul>
                </li>

                <!-- Academic Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="academicDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 10H7v-2h6v2zm0-3H7V7h6v2z"/>
                        </svg>
                        Academic
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="academicDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('student/assignments') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 2 2h8c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 10H7v-2h6v2zm0-3H7V7h6v2z"/>
                            </svg>
                            Assignments
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('student/grades') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                            My Grades
                        </a></li>
                    </ul>
                </li>

                <!-- Schedule Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="scheduleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                        </svg>
                        Schedule
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="scheduleDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('student/calendar') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                            Calendar
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('student/announcements') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                            </svg>
                            Announcements
                        </a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right side grouped navigation -->
            <ul class="navbar-nav">
                <!-- Notifications Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger" id="notification-badge" style="display: none;"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" id="notification-list" aria-labelledby="notificationDropdown">
                        <li><span class="dropdown-item-text">Loading...</span></li>
                    </ul>
                </li>

                <!-- Account Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/>
                        </svg>
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('student/profile') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/>
                            </svg>
                            Profile
                        </a></li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('logout') ?>">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M10 17v-2h4v-6h-4V7H5v10h5zm7-6l-3-3v2h-4v2h4v2l3-3z"/>
                        </svg>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>