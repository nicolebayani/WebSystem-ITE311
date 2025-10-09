<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <?php helper('url'); ?>
    <?php 
    $role = session()->get('role');
    $dashboardRoute = 'user/dashboard';
    $dashboardUrl = site_url($dashboardRoute);
    $isDashboardActive = url_is($dashboardRoute);
    ?>

    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="<?= esc($dashboardUrl) ?>">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" class="me-2">
                <path d="M12 2l9 6v8l-9 6-9-6V8l9-6zm0 2.2L5 8v6l7 4.7 7-4.7V8l-7-3.8z"/>
            </svg>
            <span class="fw-bold">Learnify User</span>
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
            </ul>

            <!-- Right side grouped navigation -->
            <ul class="navbar-nav">
                <!-- Account Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/>
                        </svg>
                        Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('user/profile') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 6v2h16v-2c0-4-4-6-8-6z"/>
                            </svg>
                            Profile
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('user/settings') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 8a4 4 0 100 8 4 4 0 000-8zm8 3h-1.09a7.006 7.006 0 00-1.27-3.06l.77-.77 1.41-1.41-2.83-2.83-1.41 1.41-.77.77A7.006 7.006 0 0013 3.09V2h-2v1.09a7.006 7.006 0 00-3.06 1.27l-.77-.77-1.41-1.41L2.93 5.01l1.41 1.41.77.77A7.006 7.006 0 003.09 11H2v2h1.09a7.006 7.006 0 001.27 3.06l-.77.77-1.41 1.41 2.83 2.83 1.41-1.41.77-.77A7.006 7.006 0 0011 20.91V22h2v-1.09a7.006 7.006 0 003.06-1.27l.77.77 1.41 1.41 2.83-2.83-1.41-1.41-.77-.77A7.006 7.006 0 0020.91 13H22v-2h-1z"/>
                            </svg>
                            Settings
                        </a></li>
                    </ul>
                </li>

                <!-- Notifications Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                        </svg>
                        Notifications
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('user/notifications') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                            </svg>
                            View All Notifications
                        </a></li>
                    </ul>
                </li>

                <!-- Support Group -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" class="me-1">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                        </svg>
                        Support
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="supportDropdown">
                        <li><a class="dropdown-item" href="<?= site_url('user/help') ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" class="me-2">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                            </svg>
                            Help & Support
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
