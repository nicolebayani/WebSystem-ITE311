<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php helper('url'); ?>
    <?php 
    $role = session()->get('role');
    $dashboardRoute = 'admin/dashboard';
    $dashboardUrl = site_url($dashboardRoute);
    $isDashboardActive = url_is($dashboardRoute);
    ?>

    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="<?= esc($dashboardUrl) ?>">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="me-2">
                <path d="M12 2l9 6v8l-9 6-9-6V8l9-6zm0 2.2L5 8v6l7 4.7 7-4.7V8l-7-3.8z"/>
            </svg>
            <span class="fw-bold">Learnify Admin</span>
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

                <!-- Management Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="managementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0018.54 7H17c-.8 0-1.54.37-2.01.99L14 9.5 12.01 7.99A2.5 2.5 0 0010 7H8.46c-.8 0-1.54.37-2.01.99L4 9.5 2.01 7.99A2.5 2.5 0 000 7v2h2v12h2v-6h2v6h2v-6h2v6h2z"/>
                        </svg>
                        Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="managementDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('admin/users') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zm4 18v-6h2.5l-2.54-7.63A1.5 1.5 0 0018.54 7H17c-.8 0-1.54.37-2.01.99L14 9.5 12.01 7.99A2.5 2.5 0 0010 7H8.46c-.8 0-1.54.37-2.01.99L4 9.5 2.01 7.99A2.5 2.5 0 000 7v2h2v12h2v-6h2v6h2v-6h2v6h2z"/>
                            </svg>
                            Manage Users
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('admin/courses') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            Manage Courses
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('admin/courses/create') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                            </svg>
                            Add Course
                        </a></li>
                    </ul>
                </li>

                <!-- Analytics Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="analyticsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                        </svg>
                        Analytics
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="analyticsDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('admin/analytics') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                            </svg>
                            System Analytics
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('admin/reports') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                            Reports
                        </a></li>
                    </ul>
                </li>

                <!-- System Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="systemDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 3h-1.09a7.006 7.006 0 00-1.27-3.06l.77-.77 1.41-1.41-2.83-2.83-1.41 1.41-.77.77A7.006 7.006 0 0013 3.09V2h-2v1.09a7.006 7.006 0 00-3.06 1.27l-.77-.77-1.41-1.41L2.93 5.01l1.41 1.41.77.77A7.006 7.006 0 003.09 11H2v2h1.09a7.006 7.006 0 001.27 3.06l-.77.77-1.41 1.41 2.83 2.83 1.41-1.41.77-.77A7.006 7.006 0 0011 20.91V22h2v-1.09a7.006 7.006 0 003.06-1.27l.77.77 1.41 1.41 2.83-2.83-1.41-1.41-.77-.77A7.006 7.006 0 0020.91 13H22v-2h-1z"/>
                        </svg>
                        System
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="systemDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('admin/settings') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 3h-1.09a7.006 7.006 0 00-1.27-3.06l.77-.77 1.41-1.41-2.83-2.83-1.41 1.41-.77.77A7.006 7.006 0 0013 3.09V2h-2v1.09a7.006 7.006 0 00-3.06 1.27l-.77-.77-1.41-1.41L2.93 5.01l1.41 1.41.77.77A7.006 7.006 0 003.09 11H2v2h1.09a7.006 7.006 0 001.27 3.06l-.77.77-1.41 1.41 2.83 2.83 1.41-1.41.77-.77A7.006 7.006 0 0011 20.91V22h2v-1.09a7.006 7.006 0 003.06-1.27l.77.77 1.41 1.41 2.83-2.83-1.41-1.41-.77-.77A7.006 7.006 0 0020.91 13H22v-2h-1z"/>
                            </svg>
                            System Settings
                        </a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right side grouped navigation -->
            <ul class="navbar-nav">
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

                <!-- Account Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/>
                        </svg>
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('admin/profile') ?>">
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